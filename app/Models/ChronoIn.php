<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChronoIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'num_debut',
        'num_fin',
        'statut'
    ];

    public $timestamps = false;
}
