<?php

namespace Groovey\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use Symfony\Component\Console\Application as AppConsole;

class Console extends ServiceProvider implements ProviderInterface
{
    public function __construct(Application $app)
    {
        $this->instance = new AppConsole();

        return $this;
    }

    public function add($classes)
    {
        $instance = $this->getInstance();
        if (is_array($classes)) {
            foreach ($classes as $class) {
                $instance->add(new $class());
            }
        }
    }

    public function run()
    {
        $instance = $this->getInstance();

        return $instance->run();
    }

    public function boot(Application $app)
    {
    }
}
