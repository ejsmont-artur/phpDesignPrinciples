<?php

namespace PhpDesignPrinciples\Tests\Unit\Patterns\Service\Strategy\HttpClientAssetServiceClientTest;

use PhpDesignPrinciples\Patterns\Service\Strategy\HttpClientAssetServiceClient;
use PhpDesignPrinciples\Patterns\Service\Config\WebServiceConfig;
use PhpDesignPrinciples\Patterns\Service\Proxy\CachingProxy;
use PhpDesignPrinciples\Patterns\Service\Proxy\ProfilingProxy;
use PhpDesignPrinciples\Patterns\Http\Strategy\PeclHttpUrlLoader;
use Doctrine\Common\Cache\ApcCache;
use PhpDesignPrinciples\Patterns\Cache\Adapter\DoctrineCacheAdapter;
use PhpDesignPrinciples\Patterns\Cache\Strategy\SimpleArrayCache;
use PhpDesignPrinciples\Patterns\Cache\Strategy\FakeCache;


/**
 * This is not an actual test it just shows how we can assemble alternative configurations
 * of objects
 */
class CodeExamplesTest extends \PHPUnit_Framework_TestCase {

    public function testMinimalAssembly() {
        $config = new WebServiceConfig();
        $httpClient = new PeclHttpUrlLoader();
        $rawService = new HttpClientAssetServiceClient($httpClient, $config);

        // these will be different as we call the service twice
        $rawService->getAsset(34)->getInstanceUid();
        $rawService->getAsset(34)->getInstanceUid();
    }

    public function testFullAssembly() {
        $this->markTestSkipped();
        $config = new WebServiceConfig();
        $cache = new SimpleArrayCache();
        $rawService = new HttpClientAssetServiceClient(new PeclHttpUrlLoader(), $config);
        $profiledService = new ProfilingProxy($rawService);
        $cachedProfiledService = new CachingProxy($profiledService, $cache);

        // these will be the same as the second call is cached
        $cachedProfiledService->getAsset(34)->getInstanceUid();
        $cachedProfiledService->getAsset(34)->getInstanceUid();
    }

    public function testFullAssemblyDoctrine() {
        $this->markTestSkipped();
        $config = new WebServiceConfig();
        $cache = new DoctrineCacheAdapter(new ApcCache());
        $rawService = new HttpClientAssetServiceClient(new PeclHttpUrlLoader(), $config);
        $profiledService = new ProfilingProxy($rawService);
        $cachedProfiledService = new CachingProxy($profiledService, $cache);

        // these will be the same as the second call is cached
        $cachedProfiledService->getAsset(34)->getInstanceUid();
        $cachedProfiledService->getAsset(34)->getInstanceUid();
    }

}