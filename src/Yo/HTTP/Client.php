<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */
 
namespace Yo\HTTP;

/**
 * Yo\HTTP\Client is a very light interface that represents the minimum set of
 * feature Yo\Client requires from the HTTP adapter.
 *
 * When using Yo\Client, you should implement an adapter. Do not rely too much
 * on the provided implementations. Instead create a new one that uses the HTTP
 * stuff you are used to using with your framework.
 */
interface Client
{
    /**
     * Send a Yo\HTTP\Request using POST
     * @param Yo\HTTP\Request $request - the request to send
     */
    public function post(Request $request);
}
