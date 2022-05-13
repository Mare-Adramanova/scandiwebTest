<?php

namespace App;

class Request
{
    /**
     * @param null $item
     * @return string|array
     */
    public function post($item = null)
    {
        if(!is_null($item)){
            return $_POST[$item];
        }

        return $_POST;
    }

    /**
     * @param null $item
     * @return string|array
     */
    public function get($item = null)
    {
        if(!is_null($item)){
            return $_GET[$item];
        }
        return $_GET;
    }
}