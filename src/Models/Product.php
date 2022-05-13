<?php

namespace App\Models;


class Product extends Model
{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $productType;

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku($sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getproductType()
    {
        return $this->productType;
    }

    public function setproductType($productType)
    {
        $this->productType = $productType;
        return $this;
    }
}
