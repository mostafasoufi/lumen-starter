<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\Mail\UserForgot;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserForgotController extends Controller
{
    use UserAccount;

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users',
        ];
    }

    /**
     * @param array $data
     * @param $code
     * @return mixed
     */
    protected function updateCode(Array $data, $code)
    {
        // Update verification code.
        User::where('email', $data['email'])->update(['verify_code' => $code]);
    }

    /**
     * @param array $data
     * @param $code
     */
    protected function sendEmail(Array $data, $code)
    {
        // Email the verification code.
        Mail::to($data['email'])->send(new UserForgot($code));
    }
}
