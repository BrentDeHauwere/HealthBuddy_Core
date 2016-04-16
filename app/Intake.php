<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
	

	/**
     * Get the medicine that owns the schedule.
     */
	public function schedule()
	{
		return $this->belongsTo('App\Schedule');
	}

}
