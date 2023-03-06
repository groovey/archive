<?php

namespace Groovey\Support\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use GuzzleHttp\Client;

class Http extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new Client();

        return $this;
    }

    public function boot(Application $app)
    {
    }
}
