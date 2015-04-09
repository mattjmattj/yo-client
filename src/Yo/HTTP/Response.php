<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */
 
namespace Yo\HTTP;

/**
 * Very simple representation of an HTTP response
 */
class Response
{
    /** @var string - the raw response */
    private $rawResponse;
    
    /** @var boolean */
    private $success;
    
    /** @var string */
    private $error;
    
    public function __construct($rawResponse)
    {
        $this->rawResponse = $rawResponse;
        $this->parseYoResponse();
    }
    
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
    
    public function isSuccess()
    {
        return $this->success;
    }
    
    public function getError()
    {
        return $this->error;
    }
    
    public function parseYoResponse()
    {
        $response = json_decode($this->rawResponse, true);
        if ($response === false) {
            return;
        }
        
        $this->success = isset($response['success']) && $response['success'];
        
        if (isset($response['error'])) {
            $this->error = $response['error'];
        }
    }
}
