<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'emp_reserv',
        'loc_reserv',
        'subclave',
        'fechalta',
        'tour',
        'nombre',
        'paxa',
        'paxb',
        'fechatour',
        'hotel',
        'cuarto',
        'agencia',
        'vendedor',
        'clavere',
        'cupon',
        'observacion',
        'precioa',
        'preciob',
        'asignada',
        'cancelada',
        'facturada',
        'usuario',
        'cortesia',
        'noshow',
        'usr_modi',
        'fecha_mod',
        'convertidor',
        'nacionalidad_reserva',
        'horaalta',
        'horamod'
    ];
    protected $table = "reservas";// <-- El nombre personalizado de la tabla

    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel');
    }

    public function agencia()
    {
        return $this->belongsTo(Clientes::class, 'agencia');
    }
}
