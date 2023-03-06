<?php

namespace Groovey\Tester;

use Groovey\Application;
use Symfony\Component\Console\Application as ConsoleApplication;

class Tester
{
    private $app;
    private $cli;
    private $console;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->cli = new ConsoleApplication();
        $this->console = new Console($app, $this->cli);
    }

    public function add(array $classes = [])
    {
        foreach ($classes as $class) {
            $obj = new $class();
            $this->console->add([$obj]);
        }

        return $this;
    }

    public function command($name)
    {
        $console = $this->console;

        $console->command($name);

        return $console;
    }
}
