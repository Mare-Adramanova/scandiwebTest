<?php

namespace App\Models;

use App\Database\QueryBuilder;
use App\DB;
use App\Models\Interfaces\ModelInterface;
use ReflectionClass;
use ReflectionProperty;

abstract class Model implements ModelInterface
{
    private QueryBuilder $builder;

    public function __construct(QueryBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->setQueryBuilder($this->builder);
    }

    public function setQueryBuilder(QueryBuilder $builder): QueryBuilder
    {
        return $builder;
    }

    public function setConnection(): DB
    {
        return $this->builder->setDbConnection();
    }

    public function save($data)
    {   
        $data = $this->defineModelType($data);
        var_dump($data);
        return $this->getQueryBuilder()->insert($data);
    }

    public function destroy($data)
    {
        $data = $this->defineModelType($data);
        $newArr = [];
        foreach ($data as $item => $datum) {
            if(str_contains($datum['table'], array_keys($datum['productType'])[$item])){
                $newArr['table'][$datum['table']] = $datum['productType'][array_keys($datum['productType'])[$item]];
            }
        }

        return $this->getQueryBuilder()->delete($newArr);
    }

    public function get(){
        return $this->getQueryBuilder()->select($this->table);
    }

    private function defineModelType($data): array
    {
        $modelsArray = [];
        $models = array_values(array_filter(get_declared_classes(), function ($item) {
            return (str_starts_with($item, 'App\Models\\'));
        }));

        $validateModel = array_map(function ($index) {
            return $index;
        }, (array)$data['productType']);

        if (!is_array($data['productType'])) {
            $currentModel = array_search('App\Models\\' . ucfirst($data['productType']), $models);
            
            return $this->mapModelPropertiesWithRequest($models[$currentModel], $data);
        }

        foreach ($validateModel as $name => $value) {
            $currentModel = array_search('App\Models\\' . ucfirst($name), $models);
            $modelsArray[] = $this->mapModelPropertiesWithRequest($models[$currentModel], $data);
            
        }

        return $modelsArray;
    }

    private function mapModelPropertiesWithRequest($model, $data): array
    {
        $preparedData = [];

        foreach ((new ReflectionClass($model))->getProperties() as $property) {
            if ($protectedProperty = (new ReflectionClass($model))->getProperties(ReflectionProperty::IS_PROTECTED)) {
                $state = (new ReflectionClass($model));
                $protectedProperty[0]->setAccessible('true');
                $preparedData['table'] = $protectedProperty[0]->getValue($state->newInstance($this->builder));
            }

            if (isset($data[$property->getName()])) {
                $preparedData[$property->getName()] = $data[$property->getName()];
            }
        }

        return $preparedData;
    }


}