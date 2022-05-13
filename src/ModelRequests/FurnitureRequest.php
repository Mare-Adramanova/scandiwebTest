<?php

namespace App\ModelRequests;

class FurnitureRequest extends ModelRequest {

    public function rules($request)
    {
        return $this->validation->required([
            'sku' => $request['sku'],
            'name' => $request['name'],
            'height'=> $_POST['height'],
            'width' => $_POST['width'],
            'length' => $_POST['length'],
            'price' => $_POST['price']
        ])->number([
            'price' => $_POST['price']
        ])->minimum([
            'sku' => $request['sku'],
        ], 3)->maximum([
            'sku' => $request['sku'],
        ], 15)
        ->getInputs();
    }
}