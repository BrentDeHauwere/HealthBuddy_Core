<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * Get the user that owns the device.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getPossbileTypes()
    {
        return ['iPhone', 'Apple Watch', 'Weegschaal'];
    }
}
