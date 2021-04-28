<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";// <-- El nombre personalizado de la tabla

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'rfc', 'type_person', 'emails', 'moviles', 'phones', 'address_id',
    ];
}