<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $primaryKey = 'clave';
    protected $table = "clientes";
    public $timestamps = false;
    protected $fillable = [
        'razon',
        'nombre',
        'direccion',
        'ciudad',
        'estado', 
        'rfc',
        'comision', 
        'diarevision', 
        'diapago',
        'diascred',
        'tcambio',
        'ctacliente',
        'ag_activa',
        'saldo_ini',
        'usr_alta',
        'fecha_alta',
        'usr_mod',
        'fecha_mod',
        'notipoc',
        'prec_prop',
        'tienecred',
        'cvexcaret',
    ];
}
