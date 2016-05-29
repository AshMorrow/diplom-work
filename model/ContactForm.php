<?php
namespace model;
use library\Request;
/**
 * Created by PhpStorm.
 * User: KoRaG
 * Date: 25.04.2016
 * Time: 15:55
 */
class ContactForm
{
    public $username;
    public $email;
    public $massage;

    public function __construct(Request $request)
    {
        $this->username = $request->post('username');
        $this->email = $request->post('email');
        $this->massage = $request->post('massage');
    }

    public function getSerializeDate(){
        return serialize($this);
    }

    public function isValid(){
        $rez = $this->username !== '' && $this->email !== '' && $this->massage !== '';
        return $rez;
    }
}