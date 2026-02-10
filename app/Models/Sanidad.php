<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'bovino_id',
        'tipo',
        'producto',
        'fecha_aplicacion',
        'proxima_dosis',
        'costo',
        'notas',
    ];

    public function bovino()
    {
        return $this->belongsTo(Bovino::class);
    }
}
