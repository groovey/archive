<?php

namespace Groovey\Support;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class Output
{
    public static function style($output)
    {
        $style = new OutputFormatterStyle('black', 'yellow');
        $output->getFormatter()->setStyle('highlight', $style);

        $style = new OutputFormatterStyle('black', 'red', ['blink']);
        $output->getFormatter()->setStyle('warning', $style);

        return $output;
    }
}
