<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */

namespace Yo;

/**
 * Interface for payloads sendable by Yo
 */
interface Payload
{
    /**
     * Converts the payload into an array compatible with \Yo\HTTP\Request
     * parameters
     * @return array
     */
    public function toHTTPParameters();
}
