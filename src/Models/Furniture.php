<?php

namespace App\Models;

class Furniture extends Product
{
    protected $height;
    protected $width;
    protected $length;
    protected $table = 'furniture';

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

    public function insert()
    {
        try {
            $sql = "
                    INSERT INTO $this->table ( sku, name, price, productType, height, width, length)  
                    VALUES ( :sku, :name, :price, :product, :height, :width, :length)
                ";
            $query = $this->setConnection()->prepare($sql);
            $query->bindValue(':sku', $this->getSku(), \PDO::PARAM_STR);
            $query->bindValue(':name', $this->getName(), \PDO::PARAM_STR);
            $query->bindValue(':price', $this->getPrice(), \PDO::PARAM_INT);
            $query->bindValue(':product', $this->getproductType(), \PDO::PARAM_STR);
            $query->bindValue(':height', $this->getHeight(), \PDO::PARAM_STR);
            $query->bindValue(':width', $this->getWidth(), \PDO::PARAM_STR);
            $query->bindValue(':length', $this->getLength(), \PDO::PARAM_STR);
            return $query->execute();
        } catch (\PDOException $exception) {
            throw new $exception();
        }
    }

    public function setFurniture()
    {
        $sql = " SELECT * FROM furniture";
        $query = $this->setConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllFurniture()
    {
        return $this->setFurniture();
    }
}
