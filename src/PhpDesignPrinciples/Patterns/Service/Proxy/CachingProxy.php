<?php

namespace PhpDesignPrinciples\Patterns\Service\Proxy;

use PhpDesignPrinciples\Patterns\Cache\CacheInterface;
use PhpDesignPrinciples\Patterns\Service\AssetServiceClientInterface;

/**
 * Caches service calls based on the method name and arguments
 * 
 * NOTE: proxy does not extend any classes, it implements the same interface that is implemented by the
 * target. Proxy is the extension cord, same plug as the hairdryer just gives you more range.
 * Proxy contains reference to the target object and may delegate calls to it.
 */
class CachingProxy implements AssetServiceClientInterface {

    /**
     * Instance to which proxy will delegate all the calls.
     * @var AssetServiceClientInterface 
     */
    private $target;

    /**
     * Instance of cache interface used to cahce objects
     * @var CacheInterface 
     */
    private $cache;

    /**
     * Prepares instqance
     * @param AssetServiceClientInterface   $target instance to delegate to on cache miss
     * @param CacheInterface                $cache  cache instance
     */
    public function __construct(AssetServiceClientInterface $target, CacheInterface $cache) {
        $this->target = $target;
        $this->cache = $cache;
    }

    /**
     * This method attempts to load asset from cache and if it is not found in cache it will
     * delegate to the target instance to fetch the asset data.
     * 
     * @param int $threadId
     * @throws Exception on any errors or if asset does not exist
     * @return AssetDto
     */
    public function getAsset($threadId) {
        $cacheKey = 'getAsset' . $threadId;
        $cachedValue = $this->cache->get($cacheKey);
        if (is_null($cachedValue)) {
            $cachedValue = $this->target->getAsset($threadId);
            $this->cache->set($cacheKey, $cachedValue);
        }
        return $cachedValue;
    }

}