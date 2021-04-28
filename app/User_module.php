<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_module extends Model
{
  protected $table = "user_module"; // <-- El nombre personalizado

  public function module()
  {
    return $this->hasMany(Modules::class);
  }

  protected $hidden = [
      'created_at', 'updated_at',
  ];

  protected $fillable = [
    'user_id', 'module_id', 'create', 'read', 'update', 'delete',
  ];

  protected $casts = [
    'create' => 'boolean',
    'read' => 'boolean',
    'update' => 'boolean',
    'delete' => 'boolean',
  ];
}
