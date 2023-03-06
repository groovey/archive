<?php

use Groovey\Application;
use PHPUnit\Framework\TestCase;

class RandomTest extends TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app->debug(true);

        $app->register('random', 'Groovey\Support\Providers\Random');

        $this->app = $app;
    }

    public function testGenerate()
    {
        $app = $this->app;
        $random = $app->get('random')->getInstance();

        $random = $random->getMediumStrengthGenerator();

        $string = $random->generateString(8);
        $this->assertEquals(8, strlen($string));

        $integer = $random->generateInt($low = 5, $high = 15);
        $this->assertTrue($high >= $integer);
        $this->assertTrue($low <= $integer);

        $string = $random->generateString(10, 'abcdef');
        $this->assertEquals(10, strlen($string));
    }
}
