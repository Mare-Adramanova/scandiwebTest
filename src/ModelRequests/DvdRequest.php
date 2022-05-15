<?php

namespace App\ModelRequests;

use http\Client\Response;

class DvdRequest extends ModelRequest {

    public function rules($request)
    {
        return $this->validation->required([
            'sku' => $request['sku'],
            'name' => $request['name'],
            'size' => $request['size'],
            'price' => $request['price']
        ])->number([
            'price' => $request['price']
        ])->minimum([
            'sku' => $request['sku'],
        ], 3)->maximum([
            'sku' => $request['sku'],
        ], 15)->unique([
            'sku' => $request['sku'],
        ], 'dvds')
        ->getInputs();
    }
}