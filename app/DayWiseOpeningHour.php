<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DayWiseOpeningHour extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='day_wise_opening_hours';
}
        