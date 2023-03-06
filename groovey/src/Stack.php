<?php

namespace Groovey;

use Symfony\Component\HttpFoundation\Request;

class Stack
{
    private $app;
    private $request;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle(array $middlewares = [])
    {
        $app = $this->app;
        $request = $this->request;
        $middlewares = $middlewares ?? false;

        if (!$middlewares) {
            return;
        }

        foreach ($middlewares as $middleware) {
            $class = new $middleware();
            $class->process($app, $request);
        }
    }
}
