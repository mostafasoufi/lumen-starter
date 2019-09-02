<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\User;

class UserVerifyController extends Controller
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
        $this->code = mt_rand(1000, 9000);
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users',
            'code' => 'required|string|digits_between:4,4|exists:users,verify_code',
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function verifyUser(Array $data)
    {
        return User::where('email', $data['email'])->update(['status' => '1', 'verify_code' => $this->code]);
    }
}
