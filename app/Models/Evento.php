<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'bovino_id',
        'tipo',
        'fecha',
        'detalle',
    ];

    public function bovino()
    {
        return $this->belongsTo(Bovino::class);
    }
}
