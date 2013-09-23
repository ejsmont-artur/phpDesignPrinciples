<?php

namespace PhpDesignPrinciples\Patterns\Cache;

/**
 * Our internal cache interface.
 * 
 * Responsible for setting and getting values in/from cache store.
 * 
 * NOTE: interface does not dictate where nor how values are cached.
 */
interface CacheInterface {

    /**
     * Load cached item or return null if not present.
     * Obviously there is no way to know if value was in cache if it was set to null.
     * 
     * @param string $key
     * @throws \Exception on any errors
     * @return mixed|null value or null if value was not found
     */
    public function get($key);

    /**
     * Save value in cache for up to optionl $ttl seconds
     * @param string    $key    cache key
     * @param mixed     $value  value to cache (will be serialised)
     * @param int       $ttl    optional seconds to live or default value set by implementation
     * @throws \Exception on any errors
     * @return void
     */
    public function set($key, $value, $ttl = null);
}