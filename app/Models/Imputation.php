<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imputation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_agent',
        'date_recpetion',
        'letter_id',
        'direction_id'
    ];

    public $timestamps = false;
}
