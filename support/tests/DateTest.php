<?php

use PHPUnit\Framework\TestCase;
use Groovey\Application;

class DateTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);

        $app->register('date', 'Groovey\Support\Providers\Date');

        $this->app = $app;
    }

    public function testDate()
    {
        $app = $this->app;
        $date = $app->get('date')->getInstance();

        $now = $date::now();
        $today = $date::today();

        $this->assertEquals(date('Y-m-d 00:00:00'), $today);
    }

    public function testFixDate()
    {
        $app = $this->app;
        $date = $app->get('date')->getInstance();

        $knownDate = $date::create(2017, 1, 23, 12);

        $date::setTestNow($knownDate);

        $now = $date::now();

        $this->assertEquals($knownDate, $now);
    }
}
