<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPageInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='menu_page_infos';
}
        