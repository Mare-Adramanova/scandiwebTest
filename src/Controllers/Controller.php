<?php

namespace App\Controllers;

use App\ModelRequests\ModelRequest;

class Controller {

    protected $modelRequest;

    public function __construct(ModelRequest $modelRequest)
    {
        $this->modelRequest = $modelRequest;
    }

    protected function redirect($response = null){
        if(!is_null($response)) {
            header('Location: ' . $response); 
            exit;
        }

        return $this;
    }

    protected function redirectBack($response = null){
        if(is_null($response)) {
            header('Location: ' . $_SERVER['REQUEST_URI']); 
            exit;
        }

        return $this;
    }
}