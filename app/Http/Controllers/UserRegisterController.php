<?php

namespace App\Http\Controllers;

use App\Http\Traits\RegisterUsers;

class UserRegisterController extends Controller
{
    use RegisterUsers;

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
}
