<?php

namespace App\Container;

interface ContainerInterface
{
    public function has(string $id);
    public function get(string $id);
}