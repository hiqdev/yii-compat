<?php

namespace hiqdev\yii\compat;

use Yii as Yii2;
use yii\helpers\Yii as Yii3;

class yii {
    public static function is2()
    {
        return !class_exists(Yii3::class);
    }

    public static function is3()
    {
        return class_exists(Yii3::class);
    }

    public static function get($name)
    {
        return class_exists(Yii3::class) ? Yii3::get($name) : Yii2::$container->get($name);
    }

    public static function getApp()
    {
        return class_exists(Yii3::class) ? Yii3::getApp() : Yii2::$app;
    }

    public static function getContainer()
    {
        return class_exists(Yii3::class) ? Yii3::getContainer() : Yii2::$container;
    }

    public static function createObject($class, $args)
    {
        return class_exists(Yii3::class) ? Yii3::createObject($class, $args) : Yii2::createObject($class, $args);
    }

    public static function getAlias($alias, $throwException = true)
    {
        return class_exists(Yii3::class) ? Yii3::getAlias($alias, $throwException) : Yii2::getAlias($alias, $throwException);
    }

    public static function error($message, $category = 'application')
    {
        return class_exists(Yii3::class) ? Yii3::error($message, $category) : Yii2::error($message, $category);
    }

    public static function warning($message, $category = 'application')
    {
        return class_exists(Yii3::class) ? Yii3::warning($message, $category) : Yii2::warning($message, $category);
    }

    public static function classKey()
    {
        return class_exists(Yii3::class) ? '__class' : 'class';
    }

    public static function referenceTo($id)
    {
        return class_exists(Yii3::class) ? \yii\di\Reference::to($id) : \yii\di\Instance::of($id);
    }

    public static function classReferenceTo($id)
    {
        return class_exists(Yii3::class) ? \yii\di\Reference::to($id) : $id;
    }
}
