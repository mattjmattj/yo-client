<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */

namespace Yo;

/**
 * Represents a location that can be sent via the Yo API
 */
class Location implements Payload
{
    private $latitude;
    private $longitude;
    
    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    public function toHTTPParameters()
    {
        return [
            'location' => sprintf('%f,%f', $this->latitude, $this->longitude),
        ];
    }
}
