<?php

use Silex\Application;

class PagingTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $this->app = $app;
    }

    public function testPaging()
    {
    }
}
