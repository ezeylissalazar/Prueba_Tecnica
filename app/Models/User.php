<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UserFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, UserFilterable;

    public static function getRoleByUserId($id)
    {
        $user = self::find($id);

        if ($user) {
            $roles = $user->getRoleNames();
            return $roles->isNotEmpty() ? $roles->first() : null;
        }

        return null;
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'id_user');
    }

    public static function getRoleId($id)
    {
        $user = self::find($id);

        if ($user) {
            $roles = $user->roles;
            $data = $roles->isNotEmpty() ? $roles->first() : null;
            return $data->id;
        }

        return null;
    }
    protected $fillable = [
        'email',
        'name',
        'password',
    ];
}
