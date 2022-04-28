<?php

namespace App\Models;

class Product extends Model
{
    protected $sku;
    protected $name;
    protected $price;
    protected $productType;
    protected $tables = ['books', 'dvds', 'furniture'];

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
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

    public function delete()
    {
        if (isset($_POST['delete']) && !empty($_POST['checkbox'])) {
            $sku = [];
            foreach ($_POST['checkbox'] as $val) {
                $sku[] =  $val;
            }
            $sku = implode("','", $sku);
            for ($i = 0; $i < count($this->tables); $i++) {
                $singleTable = $this->tables[$i];
                $sql = "
                DELETE FROM $singleTable WHERE sku IN ('" . $sku . "')
                ";
                $query = $this->setConnection()->prepare($sql);
                $query->execute();
            }
        }
    }
}
