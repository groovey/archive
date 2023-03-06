<?php

if (!function_exists('is_cli')) {
    function is_cli()
    {
        return ('cli' == php_sapi_name()) or defined('STDIN');
    }
}

if (!function_exists('cls')) {
    function cls()
    {
        return print chr(27).'[H'.chr(27).'[2J';
    }
}
