<?php

namespace App\Models;

use App\Application;
use App\Models\Interfaces\ModelInterface;

abstract class Model implements ModelInterface
{
    private $connection;

    public function setConnection()
    {
       return $this->connection = Application::db();
    }
}