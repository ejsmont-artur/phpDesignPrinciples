<?php

namespace PhpDesignPrinciples\Patterns\Cache\Strategy;

use PhpDesignPrinciples\Patterns\Cache\CacheInterface;

/**
 * Caches objects in memory, in a simple php array.
 * Useful if you are performing some batch operations and want to minimize remote calls.
 * 
 * NOTE: Strategy encapsulates a solution to the problem. Each implementation can have different way of solving the 
 * problem.
 * 
 * NOTE: Open Closed principle is leveraged here as clients do not have to change to support new ways of solving the
 * problem. They can use any of the implementations.
 * 
 * NOTE: Clients only depend on the interface not implementations.
 */
class SimpleArrayCache implements CacheInterface {

    /**
     * @var mixed[] cached values are indexed by key
     */
    private $items = array();

    /**
     * @var int|null null meaning no limit, otherwise max items count
     */
    private $maxSize;

    /**
     * Configure instance
     * 
     * @param int|null $maxItems null meaning no limit, otherwise max items count
     */
    public function __construct($maxItems = null) {
        $this->maxSize = $maxItems;
    }

    /**
     * Load cached item or return null if not present.
     * Obviously there is no way to know if value was in cache if it was set to null.
     * 
     * @param string $key
     * @throws \Exception on any errors
     * @return mixed|null value or null if value was not found
     */
    public function get($key) {
        $key = md5($key);
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        return null;
    }

    /**
     * Save value in cache for up to optionl $ttl seconds
     * @param string    $key    cache key
     * @param mixed     $value  value to cache (will be serialised)
     * @param int       $ttl    optional seconds to live or default value set by implementation
     * @throws \Exception on any errors
     * @return void
     */
    public function set($key, $value, $ttl = null) {
        $key = md5($key);
        // remove oldest item only if reached limit
        if ($this->maxSize) {
            if (count($this->items) >= $this->maxSize) {
                if (!isset($this->items[$key])) {
                    array_shift($this->items);
                }
            }
        }

        $this->items[$key] = $value;
    }

}