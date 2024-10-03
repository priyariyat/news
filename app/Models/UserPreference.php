<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = ['user_id', 'preferred_sources', 'preferred_categories'];

    protected $casts = [
        'preferred_sources' => 'array',
        'preferred_categories' => 'array',
    ];
}
