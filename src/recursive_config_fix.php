<?php

namespace hiqdev\yii\compat;

if (! function_exists('hiqdev\yii\compat\recursive_config_fix')) {
    function recursive_config_fix(array &$array): void
    {
        if (!empty($array['__class'])) {
            $array['class'] = $array['__class'];
            unset($array['__class']);
        }

        $keysToFix = [];
        foreach ($array as $key => $value) {
            if (interface_exists($key)
                || class_exists($key)
                || in_array($key, ['class', '__construct()'])
                || strpos($key, '$')
                || is_numeric($key)
            ) {
                continue;
            }
            $keysToFix[] = $key;
        }
        foreach ($keysToFix as $key) {
            $array["\$$key"] = $array[$key];
            unset($array[$key]);
        }

        foreach ($array as &$el) {
            if (is_array($el)) {
                recursive_config_fix($el);
            }
        }
    }
}
