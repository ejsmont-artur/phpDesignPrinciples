<?php

namespace PhpDesignPrinciples\Patterns\Service\Proxy;

use PhpDesignPrinciples\Patterns\Service\AssetServiceClientInterface;

/**
 * Logs execution time of each service call
 * 
 * NOTE: proxy does not extend any classes, it implements the same interface that is implemented by the
 * target. Proxy is the extension cord, same plug as the hairdryer just gives you more range.
 * Proxy contains reference to the target object and may delegate calls to it.
 * 
 * WARNING: this code has not been tested yet :)
 */
class ProfilingProxy implements AssetServiceClientInterface {

    /**
     * Instance to which proxy will delegate all the calls.
     * @var AssetServiceClientInterface 
     */
    private $target;

    /**
     * Prepares instqance
     * @param AssetServiceClientInterface $target
     */
    public function __construct(AssetServiceClientInterface $target) {
        $this->target = $target;
    }

    /**
     * Loads asset from "somewhere"
     * 
     * @param int $threadId
     * @throws Exception on any errors or if asset does not exist
     * @return PhpDesignPrinciples\Patterns\Service\Dto\AssetDto
     */
    public function getAsset($threadId) {
        $startTime = microtime(true);
        try {
            $result = $this->target->getAsset($threadId);
            $this->logTimeSince($threadId, $startTime);
            return $result;
        } catch (Exception $e) {
            $this->logTimeSince($threadId, $startTime);
            throw $e;
        }
    }

    /**
     * Logs a message
     * 
     * @param int $threadId
     * @param int $startTime
     * @return void
     */
    private function logTimeSince($threadId, $startTime) {
        $msg = sprintf("Loading threadId: %d took %9.3f seconds.", $threadId, $startTime);
        error_log($msg);
    }

}