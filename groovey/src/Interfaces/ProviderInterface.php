<?php

namespace Groovey\Interfaces;

use Groovey\Application;

interface ProviderInterface
{
    public function boot(Application $app);
}
