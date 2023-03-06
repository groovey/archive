<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

/**
 * Router logic for handling of API's
 */
class Router
{
    public $routes;
    public $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
 
    /**
     * Set route as GET
     */
    public function get($uri, $callback)
    {
        $this->add('GET', $uri, $callback);
    }

    /**
    *  Set route as POST
    */
    public function post($uri, $callback)
    {
        $this->add('POST', $uri, $callback);
    }

    /**
     *  Set route as PUT
     */
    public function put($uri, $callback)
    {
        $this->add('PUT', $uri, $callback);
    }

    /**
     * Set route as PATCH
     */
    public function patch($uri, $callback)
    {
        $this->add('PATCH', $uri, $callback);
    }

    /**
     * Set route as DELETE
     */
    public function delete($uri, $callback)
    {
        $this->add('DELETE', $uri, $callback);
    }

    /**
     * Adds the routes to an array
     */
    private function add($method, $uri, $callback)
    {
        $this->routes[] = [
            'method'   => $method,
            'uri'      => $uri,
            'callback' => $callback
        ];
    }

    /**
     * Match a specific route
     */
    private function search($method, $uri)
    {
        foreach ($this->routes as $route) {
            if ($method == $route['method'] && $uri == $route['uri']) {
                return $route;
            }
        }

        die('Page not found.');
    }

    /**
     * Calls the responsible class according to the defined parameters on the routes/api.php file
     */
    public function mount()
    {
        $request     = $this->request;
        $uri         = $request->getPathInfo();
        $method      = $request->getMethod();
        $route       = $this->search($method, $uri);
        $className   = $route['callback'][0];
        $classMethod = $route['callback'][1];
        
        $class = new $className($request);
        $class->$classMethod();
    }
}
