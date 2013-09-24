<?php

namespace PhpDesignPrinciples\Tests\Unit\Patterns\Service\Strategy\HttpClientAssetServiceClientTest;

use PhpDesignPrinciples\Patterns\Service\Strategy\HttpClientAssetServiceClient;
use PhpDesignPrinciples\Patterns\Service\Config\WebServiceConfig;

class CachingProxyTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        parent::setup();
        $this->httpClient = $this->getMock('PhpDesignPrinciples\Patterns\Http\SimpleHttpClientInterface', array(), array(), '', false);
        $this->config = new WebServiceConfig();
    }
    
    public function testFetchValid() {
        $this->assertEquals(1,1);
    }

}