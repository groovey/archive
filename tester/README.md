# Tester

Groovey Tester Package

## Installation

    $ composer require groovey/tester

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Silex\Application;
use Groovey\Tester\Providers\TesterServiceProvider;
use Groovey\Tester\Commands\About;

$app = new Application();
$app['debug'] = true;

$app->register(new TesterServiceProvider());

$app['tester']->add([
        new About($app),
    ]);

$display = $app['tester']->command('sample:about')->execute()->display();

dump($display);
``` 
