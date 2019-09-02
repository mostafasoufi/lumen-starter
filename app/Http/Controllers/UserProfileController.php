<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    /**
     * Show profile method.
     *
     * @param Request $request
     * @return ProfileResource
     */
    public function show(Request $request)
    {
        return new ProfileResource(User::find($request->user()->id));
    }

    /**
     * Update profile method.
     *
     * @param Request $request
     * @return ProfileResource
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
        ]);

        $user = User::find($request->user()->id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        $user->save();

        return new ProfileResource($user);
    }

    /**
     * Update password method.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6',
        ]);

        $password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        User::where('id', $request->user()->id)->update(['password' => $password]);

        return response()->json(['error' => false, 'message' => __('message.password.changed')]);
    }
}
