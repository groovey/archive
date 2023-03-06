<?php

if (!function_exists('limit_words')) {
    function limit_words($str, $limit = 100)
    {
        if ('' == trim($str)) {
            return $str;
        }

        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

        return rtrim($matches[0]);
    }
}

if (!function_exists('word_wrap')) {
    function word_wrap($str, $charlim = '76')
    {
        if (!is_numeric($charlim)) {
            $charlim = 76;
        }

        $str = preg_replace('| +|', ' ', $str);

        if (false !== strpos($str, "\r")) {
            $str = str_replace(array("\r\n", "\r"), "\n", $str);
        }

        $unwrap = array();
        if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches)) {
            for ($i = 0; $i < count($matches['0']); ++$i) {
                $unwrap[] = $matches['1'][$i];
                $str = str_replace($matches['1'][$i], '{{unwrapped'.$i.'}}', $str);
            }
        }

        $str = wordwrap($str, $charlim, "\n", true);

        $output = '';
        foreach (explode("\n", $str) as $line) {
            if (strlen($line) <= $charlim) {
                $output .= $line."\n";
                continue;
            }

            $temp = '';

            $cnt = 1;
            while ((strlen($line)) > $charlim) {
                if (preg_match("!\[url.+\]|://|wwww.!", $line)) {
                    break;
                }

                $temp .= substr($line, 0, $charlim - 1);
                $line = substr($line, $charlim - 1);
                ++$cnt;
            }

            if ('' != $temp) {
                $output .= $temp."\n".$line;
            } else {
                $output .= $line;
            }

            $output .= "\n";
        }

        if (count($unwrap) > 0) {
            foreach ($unwrap as $key => $val) {
                $output = str_replace('{{unwrapped'.$key.'}}', $val, $output);
            }
        }
        $output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

        return $output;
    }
}
