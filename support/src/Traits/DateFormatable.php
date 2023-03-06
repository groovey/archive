<?php

namespace Pandango\Traits;

trait DateFormatable
{
    /**
    * Attribute - $xxx->cast_start_at
    */
    public function getCastStartAtAttribute()
    {
        if ($this->start_at) {
            return $this->start_at->format('Y-m-d');
        }
        return null;
    }

    /**
     * Attribute - $xxx->cast_end_at
     */
    public function getCastEndAtAttribute()
    {
        if ($this->end_at) {
            return $this->end_at->format('Y-m-d');
        }
        return null;
    }
}