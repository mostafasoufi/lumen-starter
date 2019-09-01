<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait UserAccount
{
    /**
     * @var Verify code.
     */
    private $verify_code;

    /**
     * UserAccount constructor.
     */
    public function __construct()
    {
        $this->verify_code = mt_rand(1000, 9000);
    }

    /**
     * Register method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, $this->rules());

        try {
            $this->createUser($request->all(), $this->verify_code);
            $this->sendEmail($request->all(), $this->verify_code);

            return response()->json(['error' => false, 'message' => __('message.code.sent')]);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Verify method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verify(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->verifyUser($request->all());

        return response()->json(['error' => false, 'message' => __('message.user.verified')]);
    }

    /**
     * Forgot method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function forgot(Request $request)
    {
        $this->validate($request, $this->rules());
        
        try {
            $this->updateCode($request->all(), $this->verify_code);
            $this->sendEmail($request->all(), $this->verify_code);

            return response()->json(['error' => false, 'message' => __('message.code.sent')]);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}