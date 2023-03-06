<?php

namespace Groovey\Support\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use Groovey\Support\Trace as Debug;

class Trace extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new Debug($app);

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
