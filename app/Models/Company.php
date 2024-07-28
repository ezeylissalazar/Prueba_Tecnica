<?php

namespace App\Models;

use App\Traits\CompanyFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory,CompanyFilterable;

    public function associatedActivities()
    {
        return $this->belongsToMany(TypeActivity::class, 'activity_by_companies', 'id_company', 'id_activity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function activities()
    {
        return $this->hasMany(ActivityByCompany::class, 'id_company');
    }
}
