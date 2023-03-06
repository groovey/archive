<?php

namespace Pandango\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Optionable
{
    /**
      * This is more of a helper function, but has to be here to access a db property.
      *
      * Returns an options based on the class property
      */
    public function options(string $property, bool $sort = false, bool $ucfirst = true)
    {
        $options = collect([]);
        foreach ($this->$property as $option) {
            $value = $ucfirst ? ucfirst($option): $option;
            $options->put($option, $value);
        }

        if ($sort == true) {
            return $options->sort();
        }

        return $options;
    }
}