<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = "gastos";// <-- El nombre personalizado de la tabla
    protected  $primaryKey = 'clave';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'gasto',
        'clave_tour',
    ];

    public function clientesTours() {
        return $this->belongsTo(Tours::class, 'clave_tour');
    }
}
