<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bovino extends Model
{
    use HasFactory;

    protected $fillable = [
        'arete',
        'nombre',
        'fecha_nacimiento',
        'raza',
        'sexo',
        'peso_nacimiento',
    ];
}
