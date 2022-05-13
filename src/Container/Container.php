<?php
namespace App\Container;

use App\Exceptions\NotFoundException;

use ReflectionException;

class Container implements ContainerInterface
{
    private array $services = [];

    /**
     * @throws ReflectionException|NotFoundException
     */
    public function register(string $key, $value): Container
    {
        $this->services[$key] = $this->resolveDependency($value);
        return $this;
    }

    /**
     * @throws NotFoundException
     */
    public function get(string $id)
    {
        try {
            if (!isset($this->services[$id])) {
                $this->services[$id] = $this->resolveDependency($id);
            }
            return $this->services[$id];

        } catch (ReflectionException|\Exception $ex) {
            throw new NotFoundException($ex->getMessage());
        }
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    /**
     * @throws ReflectionException|NotFoundException
     */
    private function resolveDependency($item): ?object
    {
        if (is_callable($item)) {
            return $item();
        }

        $reflectionItem = new \ReflectionClass($item);
        return $this->getInstance($reflectionItem);
    }

    /**
     * @throws ReflectionException|NotFoundException
     */
    private function getInstance(\ReflectionClass $item): ?object
    {
        $constructor = $item->getConstructor();
        if (is_null($constructor) || $constructor->getNumberOfRequiredParameters() == 0) {
            return $item->newInstance();
        }

        $params = [];

        foreach ($constructor->getParameters() as $param) {

            if ($type = $param->getType()) {
                $params[] = $this->get($type->getName());
            }
        }

        return $item->newInstanceArgs($params);

    }

}