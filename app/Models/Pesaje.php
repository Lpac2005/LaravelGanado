<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'bovino_id',
        'fecha',
        'peso',
        'notas',
    ];

    public function bovino()
    {
        return $this->belongsTo(Bovino::class);
    }
}
