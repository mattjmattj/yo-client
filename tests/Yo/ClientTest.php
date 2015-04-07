<?php
/**
 * This file is part of mattjmattj/yo-client
 * @author Matthias Jouan <matthias.jouan@gmail.com>
 * @license BSD-2-Clause
 */

namespace Yo\Tests;

/**
 * Test case for \Yo\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function yoClientCanSendASimpleYo()
    {
        $http = $this->prophesize('\Yo\HTTP\Client');
        
        $http->post(\Prophecy\Argument::cetera())->willReturn(123456);
        
        $yo = new \Yo\Client($http->reveal(), 'FAKEKEY');
        $r = $yo->yo('FAKEUSER');
        
        $this->assertEquals(123456, $r);
        
        $expectedRequest = new \Yo\HTTP\Request();
        $expectedRequest->https = true;
        $expectedRequest->host = 'api.justyo.co';
        $expectedRequest->path = '/yo/';
        $expectedRequest->parameters = [
            'api_token' => 'FAKEKEY',
            'username' => 'FAKEUSER',
        ];
        $http->post($expectedRequest)->shouldHaveBeenCalled();
    }
    
    /**
     * @test
     */
    public function yoClientCanSendAYoWithALink()
    {
        $http = $this->prophesize('\Yo\HTTP\Client');
        $link = new \Yo\Link('http://example.com');
        
        $http->post(\Prophecy\Argument::cetera())->willReturn(123456);
        
        $yo = new \Yo\Client($http->reveal(), 'FAKEKEY');
        $r = $yo->yo('FAKEUSER', $link);
        
        $this->assertEquals(123456, $r);
        
        $expectedRequest = new \Yo\HTTP\Request();
        $expectedRequest->https = true;
        $expectedRequest->host = 'api.justyo.co';
        $expectedRequest->path = '/yo/';
        $expectedRequest->parameters = [
            'api_token' => 'FAKEKEY',
            'username' => 'FAKEUSER',
            'link' => 'http://example.com',
        ];
        $http->post($expectedRequest)->shouldHaveBeenCalled();
    }
    
    
    /**
     * @test
     */
    public function yoClientCanSendAYoWithALocation()
    {
        $http = $this->prophesize('\Yo\HTTP\Client');
        $location = new \Yo\Location(12.345678, -78.912345);
        
        $http->post(\Prophecy\Argument::cetera())->willReturn(123456);
        
        $yo = new \Yo\Client($http->reveal(), 'FAKEKEY');
        $r = $yo->yo('FAKEUSER', $location);
        
        $this->assertEquals(123456, $r);
        
        $expectedRequest = new \Yo\HTTP\Request();
        $expectedRequest->https = true;
        $expectedRequest->host = 'api.justyo.co';
        $expectedRequest->path = '/yo/';
        $expectedRequest->parameters = [
            'api_token' => 'FAKEKEY',
            'username' => 'FAKEUSER',
            'location' => '12.345678,-78.912345',
        ];
        $http->post($expectedRequest)->shouldHaveBeenCalled();
    }
    
    /**
     * @test
     */
    public function yoClientCanSendAYoToAll()
    {
        $http = $this->prophesize('\Yo\HTTP\Client');
        
        $http->post(\Prophecy\Argument::cetera())->willReturn(123456);
        
        $yo = new \Yo\Client($http->reveal(), 'FAKEKEY');
        $r = $yo->yoAll();
        
        $this->assertEquals(123456, $r);
        
        $expectedRequest = new \Yo\HTTP\Request();
        $expectedRequest->https = true;
        $expectedRequest->host = 'api.justyo.co';
        $expectedRequest->path = '/yoall/';
        $expectedRequest->parameters = [
            'api_token' => 'FAKEKEY',
        ];
        $http->post($expectedRequest)->shouldHaveBeenCalled();
    }
    
    
    /**
     * @test
     */
    public function yoClientCanSendAYoToAllWithALink()
    {
        $http = $this->prophesize('\Yo\HTTP\Client');
        $link = new \Yo\Link('http://example.com');
        
        $http->post(\Prophecy\Argument::cetera())->willReturn(123456);
        
        $yo = new \Yo\Client($http->reveal(), 'FAKEKEY');
        $r = $yo->yoAll($link);
        
        $this->assertEquals(123456, $r);
        
        $expectedRequest = new \Yo\HTTP\Request();
        $expectedRequest->https = true;
        $expectedRequest->host = 'api.justyo.co';
        $expectedRequest->path = '/yoall/';
        $expectedRequest->parameters = [
            'api_token' => 'FAKEKEY',
            'link' => 'http://example.com',
        ];
        $http->post($expectedRequest)->shouldHaveBeenCalled();
    }
}
