<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */

namespace Yo;

/**
 * Main class : The actual client to Yo API
 */
class Client
{
    private $http;
    
    private $apiToken;
    
    /**
     * @param Yo\HTTP\Client $http - an HTTP\Client implementation
     * @param string $apiToken - the Yo API key, from https://dev.justyo.co/
     */
    public function __construct(HTTP\Client $http, $apiToken)
    {
        $this->http = $http;
        $this->apiToken = $apiToken;
    }
    
    public function yo($username, Payload $payload = null)
    {
        $request = $this->prepareYoRequest($username, $payload);
        
        return $this->http->post($request);
    }
    
    public function yoAll(Link $payload = null)
    {
        $request = $this->prepareYoallRequest($payload);

        return $this->http->post($request);
    }
    
    private function prepareYoRequest($username, Payload $payload = null)
    {
        $request = new HTTP\Request();
        $request->https = true;
        $request->host = 'api.justyo.co';
        $request->path = '/yo/';
        $request->parameters = [
            'api_token' => $this->apiToken,
            'username' => $username,
        ];
        
        if (!empty($payload)) {
            $request->parameters += $payload->toHTTPParameters();
        }
        
        return $request;
    }
    
    private function prepareYoallRequest(Link $payload = null)
    {
        $request = new HTTP\Request();
        $request->https = true;
        $request->host = 'api.justyo.co';
        $request->path = '/yoall/';
        $request->parameters = [
            'api_token' => $this->apiToken,
        ];
        
        if (!empty($payload)) {
            $request->parameters += $payload->toHTTPParameters();
        }
        
        return $request;
    }
}
