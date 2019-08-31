<?php

namespace App\Http\Traits;

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
        $this->createUser($request->all());

        return response()->json(['error' => false, 'message' => __('message.user.registered')]);
    }

    public function verify(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->verifyUser($request->all());

        return response()->json(['error' => false, 'message' => __('message.user.verified')]);
    }
}