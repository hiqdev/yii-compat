<?php

namespace hiqdev\yii\compat;

class PsrContainer implements \Psr\Container\ContainerInterface
{
    /**
     * @var \yii\di\Container
     */
    private $container;

    public function __construct(\yii\di\Container $container)
    {
        $this->container = $container;
    }

    public function get($id, $params = [])
    {
        return $this->container->get($id, $params);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }
}
