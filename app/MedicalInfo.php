<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     *
     * @var string
     */
    protected $primaryKey = 'medical_info_id';

    /**
     * Get the user that owns the medicalInfo.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
