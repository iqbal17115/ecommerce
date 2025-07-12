<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Cache lifetime in seconds
     *
     * @var int
     */
    protected int $ttl;

    /**
     * Constructor to set default TTL
     *
     * @param int $ttl
     */
    public function __construct(int $ttl = 3600)
    {
        $this->ttl = $ttl;
    }

    /**
     * Retrieve data from cache or execute callback and cache the result.
     *
     * @param string $key
     * @param callable $callback
     * @param int|null $ttl
     * @return mixed
     */
    public function remember(string $key, callable $callback, ?int $ttl = null)
    {
        $ttl = $ttl ?? $this->ttl;

          if ($ttl === 0) {
        return $callback();
    }
    
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Put data into the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     * @return bool
     */
    public function put(string $key, $value, ?int $ttl = null): bool
    {
        $ttl = $ttl ?? $this->ttl;

        return Cache::put($key, $value, $ttl);
    }

    /**
     * Get data from the cache.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return Cache::get($key);
    }

    /**
     * Remove an item from the cache.
     *
     * @param string $key
     * @return bool
     */
    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }
}
