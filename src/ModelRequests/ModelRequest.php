<?php

namespace App\ModelRequests;

use App\ModelRequests\Validation;

class ModelRequest implements ModelRequestsInterface {
    
    protected Validation $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }
    
    public function rules($array)
    {
        
    }
}