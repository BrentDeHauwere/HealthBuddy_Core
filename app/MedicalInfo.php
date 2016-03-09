<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    /**
     * Get the user that owns the medicalInfo.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
