<?php

if (!function_exists('trace')) {
    function trace($msg = '')
    {
        $msg = $msg ?: 'End.';
        $breaker = is_cli() ? "\n" : '<br/>';

        return die($breaker.$msg.$breaker);
    }
}

if (!function_exists('coalesce')) {
    function coalesce(&$var, $default = null)
    {
        return isset($var) ? $var : $default;
    }
}
