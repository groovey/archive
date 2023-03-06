<?php

namespace Groovey;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Application
{
    private $debug;
    private $container;
    private $beforeMiddlewares = [];
    private $afterMiddlewares = [];

    public function __construct()
    {
        $this->container = new ContainerBuilder();

        $this->register('dumper', 'Groovey\Providers\Dumper');
        $this->register('router', 'Groovey\Providers\Router');

        return $this->container;
    }

    public function debug($value = false)
    {
        $this->debug = $value;
    }

    public function register($id, $class = null)
    {
        $container = $this->container;
        $container->register($id, $class)->setArguments([$this]);

        $provider = $this->get($id);
        $provider->boot($this);

        return $container;
    }

    public function get($value)
    {
        $container = $this->container;
        $container = $container->get($value);

        return $container;
    }

    public function mount($classes)
    {
        foreach ($classes as $class) {
            $controller = new $class();
            $controller->route($this);
        }
    }

    public function before(array $middlewares = [])
    {
        $this->beforeMiddlewares = $middlewares;
    }

    public function after(array $middlewares = [])
    {
        $this->afterMiddlewares = $middlewares;
    }

    public function handle(Request $request)
    {
        $routes = $this->get('router')->getRoutes();
        $context = new RequestContext();

        $context->fromRequest($request);

        $path = $context->getPathInfo();
        $matcher = new UrlMatcher($routes, $context);

        try {
            $parameters = $matcher->match($path);
            $class = $parameters['class'];
            $method = $parameters['method'];
            $controller = new $class();

            $stack = new Stack($this, $request);
            $stack->handle($this->beforeMiddlewares);

            $response = call_user_func_array([$controller, $method], [$this, $request]);

            $stack->handle($this->afterMiddlewares);

            return $response;
        } catch (ResourceNotFoundException $exception) {
            return new Response('Routing not found.', 404);
        } catch (\Exception $exception) {
            return new Response('An error occurred', 500);
        }
    }

    public function run(Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }

        $response = $this->handle($request);
        $response->send();
    }
}
