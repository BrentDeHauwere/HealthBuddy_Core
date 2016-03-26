<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

	/**
	     * Make sure nobody edits certain fields of the record.
	     * @var array
	     */
	protected $guarded = ['id', 'created_at', 'updated_at'];

    
    /**
     * Get the user that owns the address.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
