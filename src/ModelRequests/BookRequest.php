<?php

namespace App\ModelRequests;


class BookRequest extends ModelRequest
{
    public function rules($request)
    {
        return $this->validation->required([
            'sku' => $request['sku'],
            'name' => $request['name'],
            'weight' => $request['weight'],
            'price' => $request['price']
        ])->number([
            'price' => $request['price'],
        ])->minimum([
            'sku' => $request['sku'],
        ], 3)->maximum([
            'sku' => $request['sku'],
        ], 15)->isDecimal([
            'weight' => $request['weight'],
        ])->unique([
            'sku' => $request['sku'],
        ], 'books')
        ->getInputs();
    }
}
