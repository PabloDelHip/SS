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
        'clave_clientes_tours',
    ];

    public function clientesTours() {
        return $this->belongsTo(Clientes_Tours::class, 'clave_clientes_tours');
    }
}
