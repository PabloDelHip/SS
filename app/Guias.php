<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guias extends Model
{
    protected $table = "guias";// <-- El nombre personalizado de la tabla
    protected $primaryKey = 'clave';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'idiomas',
        'direccion',
        'telefono',
        'honorarios', 
        'aborde',
    ];
}
