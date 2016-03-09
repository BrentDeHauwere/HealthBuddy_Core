<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Hide certain columns.
     */
    protected $hidden = ['password'];

    /**
     * Get the address record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'address_id');
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
        return $this->hasOne('App\User', 'id', 'buddy_id');
    }
}
