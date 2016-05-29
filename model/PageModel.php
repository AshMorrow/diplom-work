<?php
namespace model;

class PageModel{

    public function findByAllias($alias){

        return array(
            'alias' => $alias,
            'title' => 'Welcome',
            'content' => 'This is our site'
        );

    }
}