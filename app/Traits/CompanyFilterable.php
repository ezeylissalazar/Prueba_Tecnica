<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait CompanyFilterable
{

    public function scopeFilter(Builder $query, array $filters)
    {
        return $this->applyFilters($query, $filters);
    }

    protected function applyFilters(Builder $query, array $filters)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario tiene el rol de admin
        $isAdmin = User::getRoleByUserId($user->id);


        foreach ($filters as $filter => $value) {
            $method = 'filterBy' . ucfirst($filter);

            if (method_exists($this, $method) && ($value !== null && $value !== '')) {
                $this->$method($query, $value);
            }
        }

        // Si el usuario no es admin, solo ver sus propias compañías
        if ($isAdmin !== 'admin') {
            $this->filterByUser($query, $user->id);
        }

        return $query;
    }

    public function filterByName(Builder $query, $value)
    {
        return $query->where('name', 'ilike', "%$value%");
    }

    public function filterByOwner(Builder $query, $value)
    {
        return $query->whereHas('user', function ($q) use ($value) {
            $q->where('name', 'ilike', "%$value%");
        });
    }

    public function filterByStatus(Builder $query, $value)
    {
        return $query->where('status', $value);
    }

    public function filterByWithoutActivities(Builder $query, $value)
    {
        if ($value) {
            return $query->whereDoesntHave('activities');
        }

        return $query;
    }
    public function filterByUser(Builder $query, $userId)
    {
        return $query->where('id_user', $userId);
    }
}
