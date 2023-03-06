<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Groovey\Paging\Providers\PagingServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new TwigServiceProvider(), [
        'twig.path' => __DIR__.'/../resources/templates',
    ]);

$app->register(new PagingServiceProvider(), [
        'paging.limit' => 10,
        'paging.navigation' => 7,
    ]);

$app['paging']->limit(10);
$app['paging']->navigation(7);
$app['paging']->process(1, 100);

$offset = $app['paging']->offset();
$limit  = $app['paging']->limit();

echo 'Total Records = '.$app['paging']->total();

echo $app['paging']->render();
