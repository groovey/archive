<?php

namespace Groovey\Tester\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use Groovey\Tester\Tester as Test;

class Tester extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new Test($app);

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
