<?php

namespace Groovey\Interfaces;

use Groovey\Application;
use Symfony\Component\HttpFoundation\Request;

interface MiddlewareInterface
{
    public function process(Application $app, Request $request);
}
