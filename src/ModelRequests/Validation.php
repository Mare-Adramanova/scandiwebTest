<?php

namespace App\ModelRequests;

class Validation
{
    public array $validatedInputs = [];

    public function required(array $inputs)
    {
        $validatedArray = [];
        foreach ($inputs as $name => $input) {
            if (!strlen($input) > 0) {
                $validatedArray[$name] = $input;
            }
        }

        if (count($validatedArray) > 0) {
            $this->validatedInputs[] = $validatedArray;
        }

        return $this;
    }

    public function isDecimal($inputs)
    {
        $pattern = "/^\d{0,5}\.\d{0,3}$/";

        if (!(preg_match($pattern, array_values($inputs)[0]))) {
            $this->validatedInputs[] = [array_key_first($inputs) => 'This field needs to be decimal'];
        }

        return $this;
    }
    
    public function minimum($inputs, $min)
    {
        if (strlen(array_values($inputs)[0]) < $min) {
            $this->validatedInputs[] = [
                array_key_first($inputs) => 'This field needs to be minimum ' . $min . ' characters'
            ];
        }

        return $this;
    }

    public function maximum($inputs, $max)
    {
        if (strlen(array_values($inputs)[0]) > $max) {
            $this->validatedInputs[] = [
                array_key_first($inputs) => 'This field needs to be maximum ' . $max . ' characters'
            ];
        }

        return $this;
    }

    public function number($inputs)
    {
        if (!(filter_var((int)$inputs, FILTER_VALIDATE_INT))) {
            $this->validatedInputs[] = [array_key_first($inputs) => 'This needs to be integer'];
        }

        return $this;
    }

    public function getInputs()
    {
        $preparedArray = array_merge(...$this->validatedInputs);
        if (count($preparedArray) > 0) {
            return $this->response($preparedArray);
        }
    }

    private function response($response)
    {
        $referer = $_SERVER['HTTP_REFERER'];

        header('Location: ' . $referer . '?' . http_build_query($response));
        exit;
    }
}
