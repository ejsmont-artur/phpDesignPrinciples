<?php

namespace PhpDesignPrinciples\Patterns\Http;

/**
 * Simplistic interface for fetching content over HTTP.
 * 
 * NOTE: This is a Facade pattern, we are hiding most of the complexity of HTTP protocol and libraries implementing it.
 * We only expose very high level, very simple interface for our application so that it could stay as dumb as possible
 * for as long as possible.
 * 
 * NOTE: If it was needed in the future to add options i would create SimpleHttpClientOptionsInterface
 * in the future and add methods like setConnectionTimeout() etc to control only the necessary options.
 * 
 * NOTE: By having internal Facade, you can now control default behaviour, handle errors in uniform way etc.
 */
interface SimpleHttpClientInterface {

    /**
     * Fetches some content from a HTTP server.
     * 
     * @param string $url
     * @throws \Exception on any error
     * @return string response from the server
     */
    public function get($url);
}