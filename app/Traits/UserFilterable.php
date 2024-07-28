<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait UserFilterable
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
        return $query->where('name', 'ilike', "%$value%");
    }

    public function filterByEmail(Builder $query, $value)
    {
        return $query->where('email', 'ilike', "%$value%");
    }

    public function filterByRole(Builder $query, $value)
    {
        return $query->whereHas('roles', function ($q) use ($value) {
            $q->where('name', 'ilike', "%$value%");
        });
    }

    public function filterByCompanyOwner(Builder $query, $value)
    {
        if ($value) {
            return $query->whereHas('companies');
        }

        return $query;
    }
}
