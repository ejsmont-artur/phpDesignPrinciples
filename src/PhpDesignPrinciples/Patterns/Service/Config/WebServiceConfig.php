<?php

namespace PhpDesignPrinciples\Patterns\Service\Config;

/**
 * We could use a generic config like zend config and other framework implementations where config is 
 * loaded by config key name. I used hardcoded implementation just to be quick.
 */
class WebServiceConfig {

    /**
     * Asset web service endpoint url like http://sample.com/
     * @var string
     */
    public $serviceEndpoint;

}