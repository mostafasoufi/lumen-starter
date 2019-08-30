<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait RegisterUsers
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

        $this->create($request->all());

        return response()->json(['error' => false, 'message' => 'Register has been successfully.']);
    }
}