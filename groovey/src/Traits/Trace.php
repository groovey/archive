<?php

namespace Groovey\Traits;

trait Trace
{
    public function trace($message, $option = '')
    {
        if (!$this->debug) {
            return;
        }

        return dump($message);
    }
}
