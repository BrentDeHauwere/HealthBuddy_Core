<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    /**
     * Get the user that owns the medicines.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the schedule of the medicine.
     */
    public function schedule()
    {
        return $this->hasMany('App\Schedule');
    }
}
