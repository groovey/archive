<?php

namespace Groovey\Interfaces;

use Groovey\Application;

interface ControllerInterface
{
    public function route(Application $app);
}
