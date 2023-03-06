<?php

namespace Groovey\Support\Traits;

trait DebugTrait
{
    public function debug($msg, $option = '')
    {
        if (!isset($this['config'])) {
            return;
        }

        if (!$this['config']->get('app.debug')) {
            return;
        }

        return print dump($msg);
    }
}
