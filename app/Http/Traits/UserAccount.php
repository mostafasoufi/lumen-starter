<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait UserAccount
{
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
            $this->createUser($request->all());
            $this->sendEmail($request->all());

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
            $this->updateCode($request->all());
            $this->sendEmail($request->all());

            return response()->json(['error' => false, 'message' => __('message.code.sent')]);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Reset password method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->changePassword($request->all());

        return response()->json(['error' => false, 'message' => __('message.password.changed')]);
    }
}