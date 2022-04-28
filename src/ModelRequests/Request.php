<?php 

namespace App\ModelRequests;

class Request 
{
    public function post($item){

        return $_POST[$item];
    }

    public function get($item){
        
        return $_GET[$item];
    }
}