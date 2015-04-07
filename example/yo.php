<?php
/**
 * Very simple command-line tool to send a Yo
 */
 
require __DIR__ . '/../vendor/autoload.php';

$options = getopt('t:u:l:L:');

if (!isset($options['t'],$options['u'])) {
    die("Missing arguments.\nUsage: yo.php -t <api_token> -u <target user> [-l <link> | -L <lat,lon>]\n");
}

$yo = new \Yo\Client(new \Yo\HTTP\Client\LightCurl(), $options['t']);

$payload = null;
if (isset($options['l'])) {
    $payload = new \Yo\Link($options['l']);
} elseif (isset($options['L'])) {
    list($lat,$long) = explode(',',$options['L']);
    $payload = new \Yo\Location($lat, $long);
}

$result = $yo->yo($options['u'], $payload);

var_dump($result);