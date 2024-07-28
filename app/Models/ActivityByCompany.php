<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityByCompany extends Model
{
    use HasFactory;
    protected $primaryKey = null; 
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_company',
        'id_activity',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
