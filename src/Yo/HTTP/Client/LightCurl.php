<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */
 
namespace Yo\HTTP\Client;

/**
 * Very very light implemenation of \Yo\HTTP\Client with curl.
 * @warning POC only : Not tested outside of yo-client. Incomplete. Don't use it.
 */
class LightCurl implements \Yo\HTTP\Client
{
    /**
     * Send a Yo\HTTP\Request in POST using curl
     * @param Yo\HTTP\Request $request - the request to send
     */
    public function post(\Yo\HTTP\Request $request)
    {
        $curl = \curl_init();
        
        $url = \sprintf(
            '%s://%s%s',
            $request->https ? 'https' : 'http',
            $request->host,
            $request->path
        );
        
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $request->parameters,
        ];
        
        \curl_setopt_array($curl, $options);
        
        $result = \curl_exec($curl);
        \curl_close($curl);
        
        return new \Yo\HTTP\Response($result);
    }
}
