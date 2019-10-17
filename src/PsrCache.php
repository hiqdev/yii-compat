<?php

namespace hiqdev\yii\compat;

use yii\caching\Cache;

class PsrCache implements \Psr\SimpleCache\CacheInterface
{
    /**
     * @var Cache
     */
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function get($key, $default = null)
    {
        return $this->cache->get($key) ?: $default;
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        return $this->cache->delete($key);
    }

    public function clear()
    {
        return $this->cache->flush();
    }

    public function getMultiple($keys, $default = null)
    {
        return $this->cache->multiGet($keys);
    }

    public function setMultiple($values, $ttl = null)
    {
        return $this->cache->multiSet($values, $ttl);
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->cache->delete($key);
        }
    }

    public function has($key)
    {
        return $this->cache->exists($key);
    }
}
