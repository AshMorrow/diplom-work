<?php
namespace model;
use library\Request;

class LoginForm
{
    public $email;
    public $password;

    public function __construct(Request $request)
    {
        $this->email = $request->post('email');
        $this->password = $request->post('password');
    }
    
    public function isValid(){
        $rez = $this->password !== '' && $this->email !== '';
        return $rez;
    }
}