<?php

namespace PhpDesignPrinciples\Tests\Unit\Patterns\Service\Strategy\HttpClientAssetServiceClientTest;

use PhpDesignPrinciples\Patterns\Service\Strategy\HttpClientAssetServiceClient;
use PhpDesignPrinciples\Patterns\Service\Config\WebServiceConfig;

class HttpClientAssetServiceClientTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SimpleHttpClientInterface|PHPUnit
     */
    private $httpClient;
    
    private $config;

    public function setup() {
        parent::setup();
        $this->httpClient = $this->getMock('PhpDesignPrinciples\Patterns\Http\SimpleHttpClientInterface', array(), array(), '', false);
        $this->config = new WebServiceConfig();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidId() {
        $this->httpClient->expects($this->never())->method("get");
        $instance = new HttpClientAssetServiceClient($this->httpClient, $this->config);
        $instance->getAsset(-1);
    }

    /**
     * @expectedException Exception
     */
    public function testFetchEmpty() {
        $httpResult = "";
        $this->httpClient->expects($this->once())->method("get")->will($this->returnValue($httpResult));
        $instance = new HttpClientAssetServiceClient($this->httpClient, $this->config);
        $instance->getAsset(345);
    }

    
    public function testFetchValid() {
        $this->config->serviceEndpoint = 'http:://zxc.com/';
        $httpResult = '{"abstract":"A1","title":"t1","thread_id":"34","body":"b1"}';
        $this->httpClient
                ->expects($this->once())
                ->method("get")
                ->with('http:://zxc.com/assets/v1/asset/34')
                ->will($this->returnValue($httpResult));
        $instance = new HttpClientAssetServiceClient($this->httpClient, $this->config);
        $result = $instance->getAsset(34);

        $this->assertEquals('34', $result->getThreadId());
        $this->assertEquals('t1', $result->getTitle());
    }

}