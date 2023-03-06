<?php

namespace Groovey\Validator;

use Pimple\Container;

class Validation
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function image($name)
    {
        return eregi("^.+\.(jpg|jpeg|jpe|png|gif|bmp|wbmp|rle|dib|eps|pcx|tif|tiff)$", $name) ? true : false;
    }
}
