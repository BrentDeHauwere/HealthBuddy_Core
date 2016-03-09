<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Get the address record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\Address');
    }

    /**
     * Get the medicalInfo record associated with the user.
     */
    public function medicalInfo()
    {
        return $this->hasOne('App\MedicalInfo');
    }

    /**
     * Get the buddy for the user.
     */
    public function buddy()
    {
        return $this->hasOne('App\User', 'buddy_id', 'user_id');
    }

    /**
     * Get the patients of the buddy.
     */
    public function patients()
    {
        return $this->belongsTo('App\User', 'buddy_id', 'user_id');
    }
}
