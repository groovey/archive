<?php

// NOTES: Documentation can be found here!
// https://www.codeigniter.com/user_guide/helpers/array_helper.html

if (!function_exists('element')) {
    function element($item, $array, $default = false)
    {
        if (!isset($array[$item]) or '' == $array[$item]) {
            return $default;
        }

        return $array[$item];
    }
}

if (!function_exists('elements')) {
    function elements($items, $array, $default = false)
    {
        $return = [];

        if (!is_array($items)) {
            $items = array($items);
        }

        foreach ($items as $item) {
            if (isset($array[$item])) {
                $return[$item] = $array[$item];
            } else {
                $return[$item] = $default;
            }
        }

        return $return;
    }
}

if (!function_exists('random_element')) {
    function random_element($array)
    {
        if (!is_array($array)) {
            return $array;
        }

        return $array[array_rand($array)];
    }
}
