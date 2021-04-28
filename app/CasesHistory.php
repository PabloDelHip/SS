<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasesHistory extends Model
{
    protected $table = "cases_history";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'information', 'status', 'case_id', 'user_id'
    ];

    public function cases()
    {
        return $this->belongsTo(Cases::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
