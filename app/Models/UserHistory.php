<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        'operations',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
