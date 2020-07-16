<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeAreOpen extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='we_are_opens';
}
        