<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_proforma',
        'hora_ingreso',
        'salio',
        'tecnico_id',
        'nombre_vendedor',
        'documento'
    ];

    public function tecnico() {
    	return $this->belongsTo(User::class , 'tecnico_id');
    }
}
