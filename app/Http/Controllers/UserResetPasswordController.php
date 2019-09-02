<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\User;
use App\Http\Helper;

class UserResetPasswordController extends Controller
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
            'email' => 'required|email|max:256',
            'code' => 'required|string|digits_between:4,4|exists:users,verify_code',
            'password' => 'required|min:5|max:128',
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function changePassword(Array $data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        return User::where('email', $data['email'])->update(['password' => $password, 'verify_code' => $this->code]);
    }
}
