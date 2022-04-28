<?php

namespace App;

class Config
{
    protected array $config = [];

    public function __construct($env)
    {

        $this->config = [
            'db' => [
                'host' => '127.0.0.1',
                'database' => 'test',
                'user' => 'root',
                'pass' => ''
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}
