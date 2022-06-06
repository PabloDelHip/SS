<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    protected $table = "tours";// <-- El nombre personalizado de la tabla
    protected $primaryKey = 'clave';
}
