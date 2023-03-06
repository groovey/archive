<?php

use PHPUnit\Framework\TestCase;
use Groovey\Application as App;

class ApplicationTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new App();
        $app->debug(true);

        $app->before(['Groovey\Middlewares\Before']);
        $app->after(['Groovey\Middlewares\After']);
        $app->mount(['Groovey\Controllers\Sample']);

        $this->app = $app;
    }

    public function testDumper()
    {
        $app = $this->app;

        $dumper = $app->get('dumper');

        $this->assertInstanceOf('Groovey\Providers\Dumper', $dumper);
    }
}
