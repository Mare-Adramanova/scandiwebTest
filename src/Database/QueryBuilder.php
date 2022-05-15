<?php

namespace App\Database;

use App\Application;

class QueryBuilder
{
    private $query;
    private array $data = [];

    public function setDbConnection()
    {
        return $this->connection = Application::db();
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param mixed $query
     */
    public function setQuery($query): void
    {
        $this->query = $query;
    }

    private function bindFields($fields)
    {
        return implode(', ', array_map(function ($item) {
            return ':' . $item;
        }, array_keys($fields)));
    }

    public function insert(array $data)
    {
        $this->data = $data;
        $table = array_shift($this->data);
        $columns = array_keys($this->data);
        
        $query = 'INSERT INTO ' . $table . '(' . implode(', ', $columns) . ')
        VALUES (' . $this->bindFields($this->data) . ')';

        $this->setQuery($query);

        return $this->bindValues();
    }

    public function delete($data)
    {
        for ($i = 0; $i < count($data['table']); $i++) {
            $singleTable = array_keys($data['table'])[$i];
            $ids = implode(', ',array_values($data['table'])[$i]);
            $sql = "
                DELETE FROM $singleTable WHERE id IN (" . $ids . ")
                ";
            $query = $this->setdbConnection()->prepare($sql);
            $query->execute();
        }
    }

    private function bindValues()
    {
        try {
            $statement = $this->setDbConnection()->prepare($this->query);

            if ($statement->execute($this->data)) {
                header('Location: ' . "/phpTest/");
                exit();
            }

        } catch (\PDOException $exception) {
            throw new $exception('Something went wrong');
        }
    }
    
    public function select($table){
        $sql = " SELECT * FROM $table";
        $query = $this->setDbConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function selectBySku($table, $sku){
        $sku = "'" . $sku . "'";
        $sql = " 
        SELECT * FROM $table
        WHERE `sku` = $sku;
        ";
        $query = $this->setDbConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

}