<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    protected $table = "hoteles";
    protected $primaryKey = 'clave';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'estado',
        'telefonos', 
        'zona',
        'orden', 
        'contacto', 
        'pickfijo',
        'cvehotxc',
        'status',
    ];

}
