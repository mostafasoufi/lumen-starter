<?php

namespace App\Http\Controllers;

use App\Http\Traits\UserAccount;
use App\Mail\UserRegister;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Helper;

class UserRegisterController extends Controller
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
            'verify_code' => $this->code
        ]);
    }

    /**
     * @param array $data
     */
    protected function sendEmail(Array $data)
    {
        // Email the verification code.
        Mail::to($data['email'])->send(new UserRegister($this->code));
    }
}
