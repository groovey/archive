<?php

namespace Groovey\JWT\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Groovey\JWT\JWT;

class JWTServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['jwt'] = function ($app) {

            $config = ['key' => $app['jwt.key']];

            if (isset($app['jwt.issuer'])) {
                $config['issuer'] = $app['jwt.issuer'];
            }

            if (isset($app['jwt.audience'])) {
                $config['issuer'] = $app['jwt.issuer'];
            }

            if (isset($app['jwt.expiration'])) {
                $config['expiration'] = $app['jwt.expiration'];
            } else {
                $config['expiration'] = time() + 86400;
            }

            return new JWT($app, $config);
        };
    }

    public function boot(Application $app)
    {
    }
}
