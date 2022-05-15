<?php

namespace App\Models;

class Dvd extends Product
{
    protected $table = 'dvds';

    protected $size;

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        return $this->size = $size;
    }
    
    protected function getAllRecords()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'productType' => $this->getproductType(),
            'size' => $this->getSize(),
        ];
    }

}
