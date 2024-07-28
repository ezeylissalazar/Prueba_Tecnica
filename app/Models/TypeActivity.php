<?php

namespace App\Models;

use App\Traits\ActivityFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActivity extends Model
{
    use HasFactory, ActivityFilterable;
}
