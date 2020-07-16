<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteSettings extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='website_settingses';
}
        