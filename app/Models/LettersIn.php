<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LettersIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'files',
        'date_add',
        'date_number_correspond',
        'expeditor',
        'object',
        'number',
        'type_instruction',
        'etat',
        'chrono_id',
        'user_id'
    ];
}
