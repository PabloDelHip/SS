<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_Tour extends Model
{
    protected $table = "clientes_tours";
    public $timestamps = false;
    protected $fillable = [
        'clave_tour',
        'clave_cliente',
        'descripcion',
        'tipo_cambio',
        'precio', 
        'porcentaje',
        'ganancia', 
    ];

    public function tour()
    {
        return $this->belongsTo(Tours::class, 'clave_tour');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'clave_cliente');
    }
}
