<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = "notes";// <-- El nombre personalizado de la tabla

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note', 'user_profile_id', 'user_id', 'entity', 'customer_id', 'vendor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
