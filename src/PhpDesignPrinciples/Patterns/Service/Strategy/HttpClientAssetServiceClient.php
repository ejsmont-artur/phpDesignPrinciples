<?php

namespace PhpDesignPrinciples\Patterns\Service\Strategy;

use PhpDesignPrinciples\Patterns\Service\AssetServiceClientInterface;
use PhpDesignPrinciples\Patterns\Http\SimpleHttpClientInterface;
use PhpDesignPrinciples\Patterns\Service\Dto\AssetDto;
use PhpDesignPrinciples\Patterns\Service\Config\WebServiceConfig;

/**
 * Our internal cache interface.
 * 
 * Responsible for setting and getting values in/from cache store.
 */
class HttpClientAssetServiceClient implements AssetServiceClientInterface {

    /**
     * @var SimpleHttpClientInterface 
     */
    private $client;

    /**
     * @var WebServiceConfig 
     */
    private $config;

    /**
     * Prepares instance to work
     * @param SimpleHttpClientInterface $client
     * @param WebServiceConfig          $config
     */
    public function __construct(SimpleHttpClientInterface $client, WebServiceConfig $config) {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Loads asset from "somewhere"
     * 
     * @param int $threadId
     * @throws Exception on any errors or if asset does not exist
     * @return PhpDesignPrinciples\Patterns\Service\Dto\AssetDto
     */
    public function getAsset($threadId) {
        if ($threadId <= 0) {
            throw new \InvalidArgumentException("Invalid threadId $threadId");
        }

        $url = trim($this->config->serviceEndpoint, '/') . "/assets/v1/asset/" . $threadId;
        $json = $this->client->get($url);
        $response = json_decode($json);
        if (empty($response)) {
            throw new \Exception("Invalid json message");
        }

        $result = new AssetDto();
        $result->setAbstract($response->abstract)
                ->setTitle($response->title)
                ->setThreadId($response->thread_id)
                ->setBody($response->body);

        return $result;
    }

}