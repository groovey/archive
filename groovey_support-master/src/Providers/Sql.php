<?php

namespace Groovey\Support\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;

class Sql extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new \SqlFormatter();

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
