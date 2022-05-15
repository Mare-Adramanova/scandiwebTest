<?php

namespace App\Models;

class Book extends Product
{
    protected $table = 'books';
    
    protected $weight;

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    protected function setAllRecords()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'productType' => $this->getproductType(),
            'weight' => $this->getWeight()
        ];
    }
    
}
