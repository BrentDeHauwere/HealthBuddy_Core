<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceRent extends Model
{
    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     *
     * @var string
     */
    protected $primaryKey = 'device_rent_id';
}
