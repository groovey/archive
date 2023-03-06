<?php

namespace Groovey\Paging\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Groovey\Paging\Paging;

class PagingServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['paging'] = function ($app) {

            $limit      = $app['paging.limit'];
            $navigation = $app['paging.navigation'];

            return new Paging($app, $limit, $navigation);
        };
    }

    public function boot(Application $app)
    {
    }
}
