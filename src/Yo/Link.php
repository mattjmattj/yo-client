<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */

namespace Yo;

/**
 * Represents a link that can be sent via the Yo API
 */
class Link implements Payload
{
    private $url;
    
    public function __construct($url)
    {
        $this->url = $url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function toHTTPParameters()
    {
        return ['link' => $this->url];
    }
}
