<?php

namespace Groovey\Support\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use Symfony\Component\HttpFoundation\Request as Http;

class Request extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = Http::createFromGlobals();

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
