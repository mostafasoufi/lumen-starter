<?php

namespace App\Http\Traits;

use App\Http\Resources\Profile;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait UserProfile
{
    /**
     * Show profile method.
     *
     * @param Request $request
     * @return Profile
     */
    public function show(Request $request)
    {
        return new Profile(User::find($request->user()->id));
    }

    /**
     * Update profile method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {

    }

    /**
     * Update password method.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function password(Request $request)
    {
        
    }
}