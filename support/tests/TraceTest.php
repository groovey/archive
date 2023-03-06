<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class TraceTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);

        $app->register('trace', 'Groovey\Support\Providers\Trace');

        $this->app = $app;
    }

    public function testTrace()
    {
        $app = $this->app;
        $trace = $app->get('trace')->getInstance();

        $trace->show(false);
        $trace->debug('test');

        $this->assertTrue(true);
    }

    public function testDump()
    {
        $app = $this->app;
        $trace = $app->get('trace')->getInstance();

        $trace->show(false);
        $trace->debug(['apple', 'orange']);

        $this->assertTrue(true);
    }
}
