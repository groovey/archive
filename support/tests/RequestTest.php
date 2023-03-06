<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);
        $app->register('request', 'Groovey\Support\Providers\Request');

        $_POST['post1'] = 'Hello World (POST)';
        $_GET['get1'] = 'Hello World (GET)';

        $this->app = $app;
    }

    // Weird stuff to initiate post and get variables
    public function testInit()
    {
        $app = $this->app;
        $this->assertTrue(true);
    }

    public function testPost()
    {
        $app = $this->app;
        $request = $app->get('request')->getInstance();
        $output = $request->get('post1');
        $this->assertEquals('Hello World (POST)', $output);
    }

    public function testGet()
    {
        $app = $this->app;
        $request = $app->get('request')->getInstance();
        $output = $request->get('get1');
        $this->assertEquals('Hello World (GET)', $output);
    }
}
