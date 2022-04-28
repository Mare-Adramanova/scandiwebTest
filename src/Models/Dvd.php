<?php

namespace App\Models;

class Dvd extends Product
{
    protected $table = 'dvds';

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        return $this->size = $size;
    }

    public function setAllDvds()
    {
        $sql = " SELECT * FROM dvds";

        $query = $this->setConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllDvds()
    {
        return $this->setAllDvds();
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

    public function insert()
    {
        try {
            $sql = "
                INSERT INTO $this->table ( sku, name, price, productType, size)  
                VALUES ( :sku, :name, :price, :product, :size)
                ";
            $query = $this->setConnection()->prepare($sql);
            $query->bindValue(':sku', $this->getSku(), \PDO::PARAM_STR);
            $query->bindValue(':name', $this->getName(), \PDO::PARAM_STR);
            $query->bindValue(':price', $this->getPrice(), \PDO::PARAM_INT);
            $query->bindValue(':product', $this->getProductType(), \PDO::PARAM_STR);
            $query->bindValue(':size', $this->getSize(), \PDO::PARAM_STR);
            return $query->execute();
        } catch (\PDOException $exception) {
            throw new $exception;
        }
    }
}
