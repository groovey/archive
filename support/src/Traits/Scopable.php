<?php

namespace Pandango\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Scopable
{
    /**
     * Scope::active()
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', '=', 'active');
    }

    /**
     * Scope::inactive
     */
    public function scopeInactive(Builder $query)
    {
        return $query->where('status', '=', 'inactive');
    }

    /**
     * Scope::search(['name', 'email'], 'kim')
     */
    public function scopeSearch(Builder $query, array $columns = [], string $value)
    {
        $where = [];
        foreach ($columns as $column) {
            $where[] = " $column like '%$value%' ";
        }

        return $query->whereRaw('(' . implode('or', $where)  . ')');
    }
}