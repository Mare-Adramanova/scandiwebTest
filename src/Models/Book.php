<?php

namespace App\Models;

class Book extends Product
{

    protected $table = 'books';

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    protected function getAllRecords()
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'productType' => $this->getproductType(),
            'weight' => $this->getWeight()
        ];
    }

    public function insert()
    {
        try {
            $sql = "
                    INSERT INTO $this->table ( sku, name, price, productType, weight)  
                    VALUES ( :sku, :name, :price, :product, :weight)
                    ";
            $query = $this->setConnection()->prepare($sql);
            $query->bindValue(':sku', $this->getSku(), \PDO::PARAM_STR);
            $query->bindValue(':name', $this->getName(), \PDO::PARAM_STR);
            $query->bindValue(':price', $this->getPrice(), \PDO::PARAM_INT);
            $query->bindValue(':product', $this->getproductType(), \PDO::PARAM_STR);
            $query->bindValue(':weight', $this->getWeight(), \PDO::PARAM_STR);
            return $query->execute();
        } catch (\PDOException $exception) {
            throw new $exception->getMessage();
        }
    }

    public function setAllBooks()
    {
        $sql = " SELECT * FROM books ";
        $query = $this->setConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllBooks()
    {
        return $this->setAllBooks();
    }
}
