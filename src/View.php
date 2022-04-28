<?php

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    protected $view;
    public array $params;

    public function __construct($view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }
    
    public static function make(string $view, $params = [])
    {
        return new static($view, $params);
    }

    public function render()
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }
        extract($this->params);
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}
