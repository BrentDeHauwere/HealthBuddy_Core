<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{


	/**
     * Get the schedule that owns this intake.
     */
	public function schedule()
	{
		return $this->belongsTo('App\Schedule');
	}

}
