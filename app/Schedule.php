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

    /**
     * Get the intakes of the medicine for this schedule.
     */
    public function intakes()
    {
        return $this->hasMany('App\Intakes');
    }
}
