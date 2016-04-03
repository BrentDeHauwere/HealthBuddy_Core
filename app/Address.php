<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

	/**
	     * Make sure nobody edits certain fields of the record.
	     * @var array
	     */
	protected $guarded = ['id'];

    
    /**
     * Get the user that owns the address.
     */
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
