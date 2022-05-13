<?php

namespace App\ModelRequests;

use App\ModelRequests\Interfaces\ModelRequestsInterface;
use App\ModelRequests\Validation\Validation;

abstract class ModelRequest
{
    protected Validation $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    abstract function rules($array);
}