<?php

use Silex\Application;
use Groovey\Form\Providers\FormServiceProvider;

class FormTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new FormServiceProvider());

        $this->app = $app;
    }

    public function testText()
    {
        $app = $this->app;

        $text = $app['form']->text('test', 'hello');
        $this->assertRegExp('/input/', $text);
    }
}
