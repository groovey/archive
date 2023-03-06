<?php

namespace Groovey\Form;

class Form extends Html
{
    public function open($options = [])
    {
        $attributes['accept-charset'] = 'UTF-8';

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }

        $attributes = $this->attributes($options);

        return '<form'.$attributes.'>';
    }

    public function close()
    {
        return '</form>';
    }

    public function token()
    {
        // $token = ! empty($this->csrfToken) ? $this->csrfToken : $this->session->getToken();
        $token = '';

        return $this->hidden('_token', $token);
    }

    public function text($name, $value = null, $options = [])
    {
        return $this->input('text', $name, $value, $options);
    }

    public function password($name, $options = [])
    {
        return $this->input('password', $name, '', $options);
    }
    public function hidden($name, $value = null, $options = [])
    {
        return $this->input('hidden', $name, $value, $options);
    }

    public function email($name, $value = null, $options = [])
    {
        return $this->input('email', $name, $value, $options);
    }
    public function file($name, $options = [])
    {
        return $this->input('file', $name, null, $options);
    }

    public function submit($value = null, $options = [])
    {
        return $this->input('submit', null, $value, $options);
    }

    public function label($name, $value = null, $options = [])
    {
        $options = $this->attributes($options);
        $value   = $this->formatLabel($name, $value);

        return '<label for="'.$name.'"'.$options.'>'.$value.'</label>';
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    public function radio($name, $value = null, $checked = null, $options = [])
    {
        if (is_null($value)) {
            $value = $name;
        }

        return $this->checkable('radio', $name, $value, $checked, $options);
    }

    public function select($name, $list = [], $selected = null, $options = [])
    {
        if (!isset($options['name'])) {
            $options['name'] = $name;
        }

        if (!isset($options['id'])) {
            $options['id'] = $name;
        }

        $html = [];
        foreach ($list as $value => $display) {
            $html[] = $this->getSelectOption($display, $value, $selected);
        }

        $options = $this->attributes($options);
        $list = implode('', $html);

        return "<select{$options}>{$list}</select>";
    }

    public function selectRange($name, $begin, $end, $selected = null, $options = [])
    {
        $range = array_combine($range = range($begin, $end), $range);

        return $this->select($name, $range, $selected, $options);
    }

    public function selectYear()
    {
        return call_user_func_array([$this, 'selectRange'], func_get_args());
    }

    public function selectMonth($name, $selected = null, $options = [], $format = '%B')
    {
        $months = [];
        foreach (range(1, 12) as $month) {
            $months[$month] = strftime($format, mktime(0, 0, 0, $month, 1));
        }

        return $this->select($name, $months, $selected, $options);
    }
}
