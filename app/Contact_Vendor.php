<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_Vendor extends Model
{
    protected $table = "contacts_vendors";// <-- El nombre personalizado de la tabla

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id', 'vendor_id',
    ];

    public $timestamps = false;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}