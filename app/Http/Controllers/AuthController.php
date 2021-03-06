<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users',
            'password' => 'required',
        ]);

        // Get user info.
        $user = User::where('email', $request->get('email'))->first();

        if ($user->status == 0) {
            return response()->json(['error' => true, 'message' => __('message.email.not.active')], 401);
        }

        try {

            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['error' => true, 'message' => __('message.invalid.password')], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => true, 'message' => __('token.expired')], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => true, 'message' => __('token.invalid')], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['error' => true, 'message' => __('token.absent')], 500);

        }

        return response()->json(compact('token'));
    }
}
