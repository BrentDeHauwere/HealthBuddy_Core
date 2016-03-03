<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
    * Get the address record associated with the user.
    */
    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
