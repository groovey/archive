<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);

        $app->register('http', 'Groovey\Support\Providers\Http');

        $this->app = $app;
    }

    public function testGet()
    {
        $app = $this->app;
        $http = $app->get('http')->getInstance();
        $response = $http->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
        $status = $response->getStatusCode();
        $header = $response->getHeaderLine('content-type');
        $body = $response->getBody();

        $this->assertEquals('200', $status);
        $this->assertEquals('application/json; charset=utf-8', $header);
    }
}
