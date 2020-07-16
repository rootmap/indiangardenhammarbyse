<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialLinkMgt extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='social_link_mgts';
}
        