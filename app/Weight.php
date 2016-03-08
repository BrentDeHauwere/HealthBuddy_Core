<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    /**
     * Eloquent will also assume that each table has a primary key column named id.
     * You may define a $primaryKey property to override this convention.
     *
     * @var string
     */
    protected $primaryKey = 'weight_id';
}
