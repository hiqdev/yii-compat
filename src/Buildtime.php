<?php

declare(strict_types=1);

namespace hiqdev\yii\compat;

/**
 * Buildtime marker class. Used as marker only.
 */
final class Buildtime
{
    /**
     * @param mixed $code will not be evaluated when processed with the plugin.
     */
    public static function run($code)
    {
        return $code;
    }
}
