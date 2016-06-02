<?php
namespace library;

class Request{
    private $get;
    private $post;
    private $server;
    private $request;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->request = $_REQUEST;
    }

    /**
     * Returm bool
     */

    public function isPost(){
        return (bool)$_POST;
    }

    public function isGet(){
        return (bool)$_GET;
    }

    /**
     * @param $name
     * @return mixed
     * 
     * Return query data;
     */
    
    public function get($name){
        if($this->isGet() && isset($this->get[$name])){
            return $this->get[$name];
        }else{
            return null;
        }
    }
    
    public function post($name){
        if($this->isPost()){
            return $this->post[$name];
        }
    }

    public function server($key){
        if($this->server[$key]){
            return $this->server[$key];
        }
    }

    public function getIpAddres(){
        return $this->server('REMOTE_ADDR');
    }
    
}