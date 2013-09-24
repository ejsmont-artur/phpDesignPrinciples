<?php

namespace PhpDesignPrinciples\Patterns\Service\Dto;

/**
 * Asset Data holder, no logic just data.
 * 
 * Getters and setters are on in DTO as there is no real private state, 
 * we use methods only in case we had to add some formatting/conversion/validation etc.
 * 
 * NOTE: DTO could have an interface but since there will be no logic in this class coupling to the class
 * does not pose much threat.
 * 
 * NOTE: comments are missing
 */
class AssetDto {

    private $threadId;
    private $title;
    private $abstract;
    private $body;

    /**
     * @var double this is just to see that instances are reused
     */
    private $instanceUid;

    public function __construct() {
        $this->instanceUid = md5(microtime(true) . '-' . mt_rand(1, 10000000));
    }

    public function getInstanceUid() {
        return $this->instanceUid;
    }

    public function getThreadId() {
        return $this->threadId;
    }

    /**
     * @return AssetDto
     */
    public function setThreadId($threadId) {
        $this->threadId = $threadId;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    /**
     * @return AssetDto
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getAbstract() {
        return $this->abstract;
    }

    /**
     * @return AssetDto
     */
    public function setAbstract($abstract) {
        $this->abstract = $abstract;
        return $this;
    }

    public function getBody() {
        return $this->body;
    }

    /**
     * @return AssetDto
     */
    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

}