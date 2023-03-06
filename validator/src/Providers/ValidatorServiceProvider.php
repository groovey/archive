<?php

namespace Groovey\Validator\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\Translation\Translator;
use Illuminate\Validation\Factory;
use Groovey\Validator\Validation;

class ValidatorServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['validator'] = function ($app) {

            $trans     = new Translator($locale = 'en');
            $validator = new Factory($trans);

            return $validator;
        };

        $app['validator.helper'] = function ($app) {
            return new Validation($app);
        };
    }

    public function boot(Application $app)
    {
    }
}
