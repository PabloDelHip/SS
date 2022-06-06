<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corridas extends Model
{
    protected $table = "corridas";// <-- El nombre personalizado de la tabla

    public function tour()
    {
        return $this->belongsTo(Tours::class, 'tour1');
    }

    public function guia()
    {
        return $this->belongsTo(Guias::class, 'guia1');
    }
}
