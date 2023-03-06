<?php

use PHPUnit\Framework\TestCase;
use Groovey\Application as App;

class ConsoleTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new App();
        $app->debug(true);

        $app->register('console', 'Groovey\Providers\Console');

        $this->app = $app;
    }

    public function testDumper()
    {
        $app = $this->app;

        $dumper = $app->get('dumper');

        $this->assertInstanceOf('Groovey\Providers\Dumper', $dumper);
    }

    public function testConsole()
    {
        $app = $this->app;

        $console = $app->get('console');

        $this->assertInstanceOf('Groovey\Providers\Console', $console);

        $console->add(['Groovey\Commands\Framework']);
    }
}
