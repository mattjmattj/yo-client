yo-client
=======

[![Build Status](https://travis-ci.org/mattjmattj/yo-client.svg)](https://travis-ci.org/mattjmattj/yo-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mattjmattj/yo-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mattjmattj/yo-client/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mattjmattj/yo-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mattjmattj/yo-client/?branch=master)


## Rationale

There are several Yo API wrapper available for PHP, but none of them are
satisfying to me.

First I wanted to find an implementation that was compatible with composer
and PSR-4 autoloading. If you don't care about that, you might be interested
in this very lightweight implementation : https://github.com/nanexcool/yo-php.

I also wanted to avoid any subsidiary dependency. That's why https://github.com/toin0u/yo
didn't do the trick for me, but if you don't care about dependencies then this
repo is definitely worth a try.

One last thing : I was not sure whether or not I was right to hate PSR-2 conventions,
so I had to find an excuse to try and follow them. So the code here is PSR-2
compliant... and I really don't like that.

## Install

with composer

```
composer.phar require mattjmattj/yo-client
```

## Usage

One of the main goal was **no dependencies / maximum interoperability**. This means
that, to use yo-client, you will have to implement an adapter to your favorite HTTP
client, since none is provided. To do that you need to create a class that 
implements `Yo\HTTP\Client`. This interface is pretty straightforward since it 
only has one method:

```php
public function post(\Yo\HTTP\Request $request) : \Yo\HTTP\Response
```
As long as you know how to send a POST request and return the response you're done.
(Actually if you really need an already done adapter, a very light implementation
based on curl is provided with yo-client, for testing purpose only).

The second thing you need is an API token. You can grab one in your Yo dashboard : 
https://dev.justyo.co/.

Now that the hard part is complete, just :

```php
// no : you should not use that one, but...
$http = new \Yo\HTTP\Client\LightCurl();
$api_token = '12345-67890-12345-345678';

$yo = new \Yo\Client($http, $api_token);

// you're done. You can Yo me right now :
$yo->yo('MATTJMATTJ');

// or maybe you want to Yo all your subscribers
$yo->yoAll();

// or Yo me a link to an amazing github repo
$yo->yo('MATTJMATTJ', new \Yo\Link('https://github.com/mattjmattj/yo-client'));

// or Yo me your location
$lat = 12.345;
$long = 67.891;

$yo->yo('MATTJMATTJ', new \Yo\Location($lat, $long);

```

The Yo client will return Yo API response encapsulated into a `Yo\HTTP\Response`.

## Contributing

You don't really want to do that, do you?

Every contribution is welcome, particularly if you have implemented an HTTP client
adapter and want to share it.

The source code if delivered with a makefile that performs some checks, like syntax
check or PSR-2 standards compliance. Make sure you run `make all` before submitting
a pull request.

## Next (roadmap)

Currently only sending Yos is available. We will implement the rest of Yo's API
in the future.

## License

Yo-client is licensed under BSD-2-Clause.