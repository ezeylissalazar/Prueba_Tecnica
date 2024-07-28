<?php

namespace App\Models;

use App\Traits\RequestFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory, RequestFilterable;

    protected $fillable = [
        'id_user',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); 
    }
}
