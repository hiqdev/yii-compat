<?php

use hiqdev\yii\compat\Buildtime;

return Buildtime::run(hiqdev\yii\compat\yii::is3()) ? [
    \Psr\Log\LoggerInterface::class => function ($container) {
        return \hiqdev\yii\compat\yii::getLogger($container);
    },
    \Psr\Container\ContainerInterface::class => function ($container) {
        return $container;
    },
] : [
    'container' => [
        'singletons' => [
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
        ],
    ],
];
