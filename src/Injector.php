<?php

namespace hiqdev\yii\compat;

use Psr\Container\ContainerInterface;

class Injector
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function invoke(callable $callback, $params = [])
    {
        return $this->container->invoke($callback, $params);
    }
}
