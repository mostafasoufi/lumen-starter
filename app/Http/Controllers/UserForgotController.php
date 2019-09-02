<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\Mail\UserForgot;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Helper;

class UserForgotController extends Controller
{
    use UserAccount;

    /**
     * @var int Verify code.
     */
    public $code;

    /**
     * UserRegisterController constructor.
     */
    public function __construct()
    {
        $this->code = Helper\generate_code();
    }

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
     * @return mixed
     */
    protected function updateCode(Array $data)
    {
        // Update verification code.
        User::where('email', $data['email'])->update(['verify_code' => $this->code]);
    }

    /**
     * @param array $data
     */
    protected function sendEmail(Array $data)
    {
        // Email the verification code.
        Mail::to($data['email'])->send(new UserForgot($this->code));
    }
}
