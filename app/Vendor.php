<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  protected $table = "vendors";

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
      'code', 'name', 'business_name', 'description', 'web', 'email', 'address_id', 'status',
  ];

  public function address()
  {
    return $this->belongsTo(Address::class);
  }
}