<?php

use PHPUnit\Framework\TestCase;

class HelperCustomTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Common Test Cases
    |--------------------------------------------------------------------------
    */

    public function testCoalesce()
    {
        $output = coalesce($_GET['value'], 'There is no value!');
        $this->assertEquals('There is no value!', $output);
    }

    /*
    |--------------------------------------------------------------------------
    | Array Test Cases
    |--------------------------------------------------------------------------
    */

    public function testElement()
    {
        $array = [
                    'color' => 'red',
                    'shape' => 'round',
                    'size' => '',
                ];

        $output = element('color', $array);
        $this->assertEquals('red', $output);

        $output = element('size', $array, 'foobar');
        $this->assertEquals('foobar', $output);
    }

    public function testElements()
    {
        $array = [
                    'color' => 'red',
                    'shape' => 'round',
                    'radius' => '10',
                    'diameter' => '20',
                ];

        $output = elements(array('color', 'shape', 'height'), $array);
        $this->assertArrayHasKey('color', $output);
        $this->assertArrayHasKey('shape', $output);
        $this->assertArrayHasKey('height', $output);

        $output = elements(array('color', 'shape', 'height'), $array, 'foobar');
        $this->assertArrayHasKey('height', $output);
    }

    public function testRandomElement()
    {
        $quotes = [
        'I find that the harder I work, the more luck I seem to have. test - Thomas Jefferson',
        "Don't stay in bed, unless you can make money in bed. test - George Burns",
        "We didn't lose the game; we just ran out of time. test - Vince Lombardi",
        "If everything seems under control, you're not going fast test enough. - Mario Andretti",
        'Reality is merely an illusion, albeit a very persistent test one. - Albert Einstein',
        'Chance favors the prepared mind test - Louis Pasteur',
        ];

        $quote = random_element($quotes);

        $this->assertContains('test', $quote);
    }

    // /*
    // |--------------------------------------------------------------------------
    // | CLI Test Cases
    // |--------------------------------------------------------------------------
    // */

    // /*
    // |--------------------------------------------------------------------------
    // | String Test Cases
    // |--------------------------------------------------------------------------
    // */

    public function testLimitWords()
    {
        $output = limit_words('The quick brown fox.', 2);
        $this->assertEquals('The quick', $output);
    }

    public function testWordWrap()
    {
        $output = word_wrap('The quick brown fox jumps over the lazy dog.', 15);
        $this->assertRegExp('/lazy dog/', $output);
    }

    // /*
    // |--------------------------------------------------------------------------
    // | HTML Test Cases
    // |--------------------------------------------------------------------------
    // */
    public function testEntities()
    {
        $output = entities("A 'quote' is <b>bold</b>");
        $this->assertEquals('A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;', $output);
    }
}
