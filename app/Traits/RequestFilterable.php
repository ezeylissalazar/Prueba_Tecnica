<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait RequestFilterable
{
    public function scopeFilter(Builder $query, array $filters)
    {
        return $this->applyFilters($query, $filters);
    }

    protected function applyFilters(Builder $query, array $filters)
    {
        foreach ($filters as $filter => $value) {
            $method = 'filterBy' . ucfirst($filter);

            if (method_exists($this, $method) && ($value !== null && $value !== '')) {
                $this->$method($query, $value);
            }
        }

        return $query;
    }

    public function filterByName(Builder $query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            $q->where('name', 'ilike', "%$value%");
        });
    }

    public function filterByStatus(Builder $query, $value)
    {
        return $query->where('status', $value);
    }
}
