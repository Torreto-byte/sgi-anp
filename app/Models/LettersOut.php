<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LettersOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'files',
        'date_send',
        'date_number_correspond',
        'sender',
        'object',
        'number',
        'date_reception',
        'observation',
        'etat',
        'status',
        'chrono_id',
        'user_id'
    ];
}
