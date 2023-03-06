<?php

namespace Groovey\Breadcrumb\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Groovey\Breadcrumb\Breadcrumb;

class BreadcrumbServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['breadcrumb'] = function ($app) {
            return new Breadcrumb($app);
        };
    }

    public function boot(Application $app)
    {
    }
}
