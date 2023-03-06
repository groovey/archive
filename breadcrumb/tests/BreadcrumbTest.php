<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Groovey\Breadcrumb\Providers\BreadcrumbServiceProvider;

class BreadcrumbTest extends PHPUnit_Framework_TestCase
{
    public $app;

    public function setUp()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new TwigServiceProvider(), [
                    'twig.path' => __DIR__.'/../resources/templates',
                ]);

        $app->register(new BreadcrumbServiceProvider());

        $this->app = $app;
    }

    public function testBreadcrumb()
    {
        $app = $this->app;

        $app['breadcrumb']->add('Home', '/home.php', 'home.html');
        $app['breadcrumb']->add('Category', '/category.php');
        $app['breadcrumb']->add('Edit', '#');

        $output = $app['breadcrumb']->render();

        $this->assertRegExp('/Home/', $output);
    }
}
