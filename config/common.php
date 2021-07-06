<?php

$singletons = [
    \yii\base\Application::class => function ($container) {
        return \hiqdev\yii\compat\yii::getApp($container);
    },
    \Psr\Container\ContainerInterface::class => function ($container) {
        return \hiqdev\yii\compat\yii::getPsrContainer($container);
    },
    \Psr\SimpleCache\CacheInterface::class => function ($container) {
        return \hiqdev\yii\compat\yii::getPsrCache($container);
    },
    \Psr\Log\LoggerInterface::class => function ($container) {
        return \hiqdev\yii\compat\yii::getPsrLogger($container);
    },
];

return class_exists(\Yiisoft\Factory\Definition\Reference::class)
    ? [
        \Psr\Log\LoggerInterface::class => function (\Psr\Container\ContainerInterface $container) {
            return \hiqdev\yii\compat\yii::getPsrLogger($container);
        }
    ]
    : ['container' => ['singletons' => $singletons]]
;
