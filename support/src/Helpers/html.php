<?php

if (!function_exists('entities')) {
    function entities($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}
