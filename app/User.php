<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model, Authenticatable
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
     * Get the buddy of the patient.
     */
    public function buddy()
    {
        return $this->hasOne('App\User', 'id', 'buddy_id');
    }

    /**
     * Get the patients of the buddy.
     */
    public function patients()
    {
        return $this->hasMany('App\User', 'buddy_id', 'id');
    }

    /**
     * Get the devices of the user.
     */
    public function devices()
    {
        return $this->hasMany('App\Device');
    }
}
