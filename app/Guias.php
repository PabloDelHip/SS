<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guias extends Model
{
    protected $table = "guias";// <-- El nombre personalizado de la tabla
    protected $primaryKey = 'clave';
}
