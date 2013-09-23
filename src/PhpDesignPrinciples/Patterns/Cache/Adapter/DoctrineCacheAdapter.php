<?php

namespace PhpDesignPrinciples\Patterns\Cache\Adapter\DoctrineCacheAdapter;

use PhpDesignPrinciples\Patterns\Cache\CacheInterface;
use Doctrine\Common\Cache\Cache;

/**
 * Class is an adapter between Doctrine\Cache and CircuitBreaker\Storage interfaces.
 * 
 * NOTE: Adapter usually does not have much logic and all it has to do is to translate one programatic interface into
 * another. Since we have our own PhpDesignPrinciples\Patterns\Cache\CacheInterface our code is coupled to our own 
 * interface and can not directly use Doctrine's implementations.
 * 
 * NOTE: Adapter is a traveler's plug adapter. The basic functionality of different electrical sockets are the same
 * but the plugs have different shapes. Adapter converts messages between the interfaces so that clients may remain 
 * the same and they do not have to know that there is some incompatible implementation in use. 
 * 
 * NOTE: Adapters are usually used to to reuse 3rd party library without coupling directly to it. This is example of 
 * such reuse. We can use any of the Doctrines implementations but our application will not be aware of it and will
 * not be coupled to Doctrine itself. We can switch to zend or anything we want at any time without changing the app.
 * 
 * NOTE: Adapter is also known as Wrapper, as it wraps existing functionality and presents it in different form.
 */
class DoctrineCacheAdapter implements CacheInterface {

    /**
     * Instance to be used by the adapter. It can be any Doctrine's implementation: File, Memcached, Apc, whatever.
     * @var \Doctrine\Common\Cache\Cache $doctrineCacheInstance 
     */
    private $doctrineCacheInstance;

    /**
     * Expects doctring cache implementation instance to route 
     * circuit breaker calls. Instance have to be ready to use.
     * 
     * @param \Doctrine\Common\Cache\Cache $doctrineCacheInstance
     */
    public function __construct(Cache $doctrineCacheInstance) {
        $this->doctrineCacheInstance = $doctrineCacheInstance;
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
        return $this->doctrineCacheInstance->fetch($key);
    }

    /**
     * Save item in the cache.
     * 
     * @param string $key
     * @param string $value
     * @param int $ttl
     * 
     * @throws \Exception on error
     * 
     * @return void
     */
    public function set($key, $value, $ttl = null) {
        $this->doctrineCacheInstance->save($key, $value, $ttl);
    }

}