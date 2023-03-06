<?php

namespace Groovey\Controllers;

use Groovey\Application;
use Groovey\Interfaces\ControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class Sample implements ControllerInterface
{
    public function route(Application $app)
    {
        $router = $app->get('router', $instance = false);
        $router->add('/', [$this, 'index']);
        $router->add('/sample', [$this, 'sample']);

        return;
    }

    public function index(Application $app, Request $request)
    {
        $method = $request->getMethod();

        dump('Sample Controller :: index');

        return new Response();
    }

    public function sample(Application $app, Request $request)
    {
        return new Response();
    }

    public function before(Application $app, Request $request)
    {
        echo 'before';

        return;
    }

    public function after(Application $app, Request $request)
    {
        echo 'after';

        return new Response();
    }
}
