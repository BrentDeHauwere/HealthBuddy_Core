<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{

	/**
     * Make sure nobody edits certain fields of the record.
     * @var array
     */
	protected $guarded = ['id', 'created_at', 'updated_at'];

	/**
     * Get the schedule that owns this intake.
     */
	public function schedule()
	{
		return $this->belongsTo('App\Schedule');
	}

}
