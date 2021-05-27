<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombre',
        'celular',
        'fecha_ingreso',
        'problema',
        'salio',
    ];
}
