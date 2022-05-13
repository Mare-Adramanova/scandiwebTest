<?php

namespace App\Models\Interfaces;

interface ModelInterface
{
    public function setConnection();
    public function save($data);
}