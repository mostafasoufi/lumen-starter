<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\User;

class UserVerifyController extends Controller
{
    use UserAccount;

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users',
            'code' => 'required|string|min:4|exists:users,verify_code',
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function verifyUser(Array $data)
    {
        return User::where(['email' => $data['email'], 'verify_code' => $data['code']])->update(['status' => '1']);
    }
}
