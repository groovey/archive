<?php

namespace Groovey\Middlewares;

use Groovey\Application;
use Groovey\Interfaces\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;

class After implements MiddlewareInterface
{
    public function process(Application $app, Request $request)
    {
        dump('After Middleware :: process');
    }
}
