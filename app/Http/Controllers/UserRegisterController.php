<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\Mail\UserRegister;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserRegisterController extends Controller
{
    use UserAccount;

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function createUser(Array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'verify_code' => mt_rand(1000, 9000)
        ]);
    }

    /**
     * @param array $data
     * @param $code
     */
    protected function sendEmail(Array $data, $code)
    {
        // Email the verification code.
        Mail::to($data['email'])->send(new UserRegister($code));
    }
}
