<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * Hide certain columns.
     */
    protected $hidden = ['password', 'remember_token', 'api_token'];

    /**
     * Make sure nobody edits certain fields of the record.
     * @var array
     */
    protected $guarded = ['id', 'password', 'role', 'address_id',
        'remember_token', 'api_token', 'created_at', 'updated_at'];

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

    /**
     * Get the weights of the user.
     */
    public function weights()
    {
        return $this->hasMany('App\Weight');
    }

    /**
     * Get the medicines of the user.
     */
    public function medicines()
    {
        return $this->hasMany('App\Medicine');
    }
}
