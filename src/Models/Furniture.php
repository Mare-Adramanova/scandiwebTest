<?php

namespace App\Models;

class Furniture extends Product
{
    protected $table = 'furniture';

    protected $height;
    protected $width;
    protected $length;

    public function getTable(){
        return $this->table;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        return $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        return $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        return $this->length = $length;
    }

    protected function getAllRecords()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'productType' => $this->getproductType(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'length' => $this->getLength(),
        ];
    }

}
