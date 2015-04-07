<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */
 
namespace Yo\HTTP;

/**
 * Very simple representation of an HTTP request
 */
class Request
{
    /**
     * @var boolean - HTTPS or not ?
     */
    public $https = false;
    
    /**
     * @string
     */
    public $host;
    
    /**
     * @var string
     */
    public $path;
    
    /**
     * @var array
     */
    public $parameters = [];
}
