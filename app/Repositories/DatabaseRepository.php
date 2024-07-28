<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Request;
use App\Models\TypeActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DatabaseRepository
{

    public function __construct()
    {
    }

    public static function getRequest()
    {
        return Request::join('users', 'requests.id_user', 'users.id')
            ->select('requests.*', 'users.name')
            ->get();
    }

    public static function getCompanies()
    {
        $user = Auth::user();
        $role = User::getRoleByUserId($user->id);

        $query = Company::join('users', 'companies.id_user', '=', 'users.id')
            ->select('companies.*', 'users.name as username');

        if ($role == 'admin') {
            return $query->get();
        } else {
            return $query->where('companies.id_user', $user->id)->get();
        }
    }

    public static function getUsers()
    {
        return User::select('id', 'name','email')->get();
    }

    public static function getTypeOfActivities()
    {
        return TypeActivity::select('id', 'name')->get();
    }
}
