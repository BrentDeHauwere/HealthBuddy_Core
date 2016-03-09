<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'medicalInfos';

    /**
     * Get the user that owns the medicalInfo.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
