<?php
namespace model;


use library\Request;

class RegistrationForm
{
    public $nick_name;
    public $birthday;
    public $email;
    public $password;

    public function __construct(Request $request)
    {
        $this->nick_name = trim(strip_tags($request->post('nick_name')));
        $this->birthday = trim(strip_tags($request->post('birthday')));
        $this->email = trim(strip_tags($request->post('email')));
        $this->password = trim(strip_tags($request->post('password')));
    }
    
    public function is_valid(){
        $valid = 
            $this->nick_name != '' &&
            $this->birthday != '' &&
            $this->email != '' &&
            $this->password != '';
        
        return $valid;
    }
}