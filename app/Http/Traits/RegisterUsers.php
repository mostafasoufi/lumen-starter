<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait RegisterUsers
{
    /**
     * Register method.
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->validate($request, $this->rules());
    }
}