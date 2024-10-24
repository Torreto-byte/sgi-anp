<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChronoOut extends Model
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
