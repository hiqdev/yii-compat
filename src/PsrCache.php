<?php declare(strict_types=1);

namespace hiqdev\yii\compat;

use Psr\SimpleCache\CacheInterface;
use yii\caching\Cache;

readonly class PsrCache implements CacheInterface
{
    public function __construct(private Cache $cache)
    {
    }

    public function get($key, $default = null): mixed
    {
        return $this->cache->get($key) ?: $default;
    }

    public function set($key, $value, $ttl = null): bool
    {
        return $this->cache->set($key, $value, $ttl);
    }

    public function delete($key): bool
    {
        return $this->cache->delete($key);
    }

    public function clear(): bool
    {
        return $this->cache->flush();
    }

    public function getMultiple($keys, $default = null): iterable
    {
        return $this->cache->multiGet($keys);
    }

    public function setMultiple($values, $ttl = null): bool
    {
        if ($values instanceof \Traversable) {
            $values = iterator_to_array($values);
        }

        $failedKeys = $this->cache->multiSet($values, $ttl);

        return is_array($failedKeys) ? $failedKeys === [] : (bool)$failedKeys;
    }

    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->cache->delete($key);
        }
    }

    public function has($key): bool
    {
        return $this->cache->exists($key);
    }
}
