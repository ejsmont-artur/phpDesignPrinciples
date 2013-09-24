<?php

namespace PhpDesignPrinciples\Patterns\Http\Strategy;

use PhpDesignPrinciples\Patterns\Http\SimpleHttpClientInterface;
use \Exception;
use \HttpRequest;

/**
 * Uses PECL to fetch urls.
 * 
 * WARNING: this code has not been tested yet :)
 */
class PeclHttpUrlLoader implements SimpleHttpClientInterface {

    /**
     * Fetches content from a HTTP server.
     * 
     * @param string $url
     * @throws Exception on any error
     * @return string response from the server
     */
    public function get($url) {
        $request = $this->getRequest($url, HttpRequest::METH_GET);
        try {
            // this could be parametrized using optional options interface
            $options = array(
                'useragent' => "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; InfoPath.1; MS-RTC LM 8)",
                'connecttimeout' => 120, // timeout in seconds on connect 
                'timeout' => 120, // timeout in seconds on response 
                'redirect' => 5, // stop after 5 redirects
                'compress' => true, // allow compression or  not
                'referer' => "https://www.google.com/#output=search&sclient=psy-ab&q=jachty&fp=1",
            );
            $request->setOptions($options);
            $request->send();
        } catch (Exception $e) {
            throw new Exception('Loading failed with exception', $request->getResponseCode(), $e);
        }
        $code = $request->getResponseCode();
        $body = $request->getResponseBody();

        // make sure we did not fail
        if ($code >= 500) {
            throw new Exception('Error response code recieved: ' . $body, $code);
        } elseif ($code >= 400) {
            throw new Exception('Permanent failure' . $body, $code);
        } elseif (trim($body) == '') {
            throw new Exception('Empty response', $code);
        }

        return $body;
    }

    /**
     * Separate method just to let us mock the instance returned, we dont want to send real requests in tests.
     * 
     * NOTE: You also could override it in subclass if you really had to but it is probably not a good idea.
     * 
     * @param string $url URL to be loaded
     * @param string $method one of the constants as HttpRequest::METH_GET
     * @return HttpRequest
     */
    protected function getRequest($url, $method) {
        return new HttpRequest($url, $method);
    }

}
