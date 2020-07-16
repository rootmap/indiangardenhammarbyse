<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurHistory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='our_histories';
}
        