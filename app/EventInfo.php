<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='event_infos';
}
        