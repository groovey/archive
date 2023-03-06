<?php

namespace Groovey\Providers;

use Groovey\Application;
use Groovey\ServiceProvider;
use Groovey\Interfaces\ProviderInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class Router extends ServiceProvider implements ProviderInterface
{
    private $routes;

    public function __construct(Application $app)
    {
        $this->routes = new RouteCollection();
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function add($pattern, array $parts = [])
    {
        $routes = $this->routes;
        $class = get_class($parts[0]);
        $method = $parts[1];
        $instance = new $class();
        $reflection = new \ReflectionClass($instance);
        $className = $reflection->getShortName();
        $index = strtolower($className.'_'.$method);
        $$index = new Route($pattern, array('class' => $class, 'method' => $method));

        $routes->add($index, $$index);

        return $class;
    }

    public function boot(Application $app)
    {
    }
}
