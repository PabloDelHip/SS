<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model 
{
  protected $table = "modules"; // <-- El nombre personalizado

  public function permits()
  {
    return $this->belongsToMany(User_modul::class, 'user_id')->withPivot('user_id','module_id');
  }

  protected $fillable = [
    'name', 'status'
  ];
}
