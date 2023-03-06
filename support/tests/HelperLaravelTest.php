<?php

// More helper functions:
// https://laravel.com/docs/master/helpers

use PHPUnit\Framework\TestCase;

class HelperLaravelTest extends TestCase
{
    public function testLast()
    {
        $array = [100, 200, 300];
        $last = last($array);

        $this->assertEquals('300', $last);
    }

    public function testStartsWith()
    {
        $value = starts_with('This is my name', 'This');
        $this->assertTrue($value);
    }
}
