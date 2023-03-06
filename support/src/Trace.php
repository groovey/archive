<?php

namespace Groovey\Support;

class Trace
{
    private $app;
    private $show;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function show($flag = false)
    {
        $this->show = $flag;
    }

    public function debug($value, $plain = false)
    {
        $app = $this->app;
        $show = $this->show;

        if (!$show) {
            return;
        }

        if ($plain) {
            echo(is_cli() ? "\n" : '<br/>').$value;
        } else {
            dump($value);
        }
    }

    public function dump($value)
    {
        $app = $this->app;
        $show = $this->show;

        if ($show) {
            dump($value);
        }
    }
}
