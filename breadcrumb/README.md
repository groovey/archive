# Breadcrumb

Groovey Breadcrumb Package

## Installation

    $ composer require groovey/breadcrumb

## Usage

```php
<?php

include_once '/vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Groovey\Breadcrumb\Providers\BreadcrumbServiceProvider;

$app = new Application();
$app['debug'] = true;

$app->register(new TwigServiceProvider(), [
        'twig.path' => __DIR__.'/../templates'
    ]);

$app->register(new BreadcrumbServiceProvider());

$app['breadcrumb']->add('Home', '/home.php', 'home.html');
$app['breadcrumb']->add('Category', '/category.php');
$app['breadcrumb']->add('Edit', '#');

echo $app['breadcrumb']->render();

```