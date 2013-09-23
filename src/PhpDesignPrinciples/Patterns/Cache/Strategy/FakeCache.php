<?php

namespace PhpDesignPrinciples\Patterns\Cache\Strategy;

use PhpDesignPrinciples\Patterns\Cache\CacheInterface;

/**
 * Fake implementation of Cache, does not cache anything.
 * Clients would not know cache was disabled and that they got a fake instance.
 */
class FakeCache implements CacheInterface {

    /**
     * 100% cache miss.
     * 
     * @param string $key
     * @throws \Exception on any errors
     * @return mixed|null value or null if value was not found
     */
    public function get($key) {
        return null;
    }

    /**
     * Does nothing.
     * 
     * @param string    $key    cache key
     * @param mixed     $value  value to cache (will be serialised)
     * @param int       $ttl    optional seconds to live or default value set by implementation
     * @throws \Exception on any errors
     * @return void
     */
    public function set($key, $value, $ttl = null) {
        // do nothing
    }

}