<?php

namespace hiqdev\yii\compat;

use Yii as Yii2;
use yii\di\Instance;
use yii\mutex\FileMutex;
use Yiisoft\Factory\Definitions\Reference;
use Psr\Container\ContainerInterface;

class yii
{
    private static $isYii3;

    public static function is2()
    {
        if (self::$isYii3 === null) {
            self::$isYii3 = class_exists(Reference::class);
        }

        return !self::$isYii3;
    }

    public static function is3()
    {
        if (self::$isYii3 === null) {
            self::$isYii3 = class_exists(Reference::class);
        }

        return self::$isYii3;
    }

    public static function get($name)
    {
        return self::is3() ? Yii3::get($name) : Yii2::$container->get($name);
    }

    public static function getApp()
    {
        return self::is3() ? Yii3::getApp() : Yii2::$app;
    }

    public static function getContainer()
    {
        return self::is3() ? Yii3::getContainer() : Yii2::$container;
    }

    public static function getPsrContainer($container)
    {
        return $container instanceof ContainerInterface ? $container : new PsrContainer($container);
    }

    public static function getPsrLogger($container = null)
    {
        return self::is3() ? $container->get('logger') : new PsrLogger(Yii2::getLogger());
    }

    public static function getPsrCache($container = null)
    {
        $cache = ($container ?? self::getContainer())->get('cache');
        return self::is3() ?  : new PsrCache($cache);
    }

    public static function getLogger()
    {
        return self::is3() ? Yii3::getContainer()->get('logger') : Yii2::getLogger();
    }

    public static function setLocale($locale)
    {
        return self::is3() ? Yii3::getApp()->setLocale($locale) : Yii2::$app->language = $locale;
    }

    public static function createObject($class, array $params = [])
    {
        return self::is3() ? Yii3::createObject($class, $params) : Yii2::createObject($class, $params);
    }

    public static function getAlias($alias, $throwException = true)
    {
        return self::is3() ? Yii3::getAlias($alias, $throwException) : Yii2::getAlias($alias, $throwException);
    }

    public static function error($message, $category = 'application')
    {
        return self::is3() ? Yii3::error($message, $category) : Yii2::error($message, $category);
    }

    public static function warning($message, $category = 'application')
    {
        return self::is3() ? Yii3::warning($message, $category) : Yii2::warning($message, $category);
    }

    public static function referenceTo($id)
    {
        return self::is3() ? Reference::to($id) : Instance::of($id);
    }

    public static function classReferenceTo($id)
    {
        return self::is3() ? Reference::to($id) : $id;
    }

    public static function newArrayCache()
    {
        return self::is3() ? new \yii\cache\ArrayCache() : new PsrCache(new \yii\caching\ArrayCache());
    }

    public static function newFileMutex()
    {
        return self::is3() ? new FileMutex(static::getAlias('@runtime/mutex')) : new FileMutex();
    }
}
