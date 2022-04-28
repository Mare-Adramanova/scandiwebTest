<?php

namespace App\ModelRequests;

class DvdRequest extends ModelRequest {

    public function rules($request)
    {
        $this->validation->required([
            'sku' => $request['sku'],
            'name' => $request['name'],
            'size' => $request['size'],
            'price' => $request['price']
        ])->number([
            'price' => $_POST['price']
        ])->minimum([
            'sku' => $request['sku'],
        ], 3)->maximum([
            'sku' => $request['sku'],
        ], 7)
        ->getInputs();
    }
}