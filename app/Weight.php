<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    /**
     * Get the user that owns the weight.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
