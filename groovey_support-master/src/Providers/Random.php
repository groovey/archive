<?php

namespace Groovey\Support\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use RandomLib\Factory;

class Random extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new Factory();

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
