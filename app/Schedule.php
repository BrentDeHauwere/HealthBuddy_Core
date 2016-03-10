<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Get the medicine that owns the schedule.
     */
    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }
}
