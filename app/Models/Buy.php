<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $fillable = [

    	'user_id','course_id','price','ref_id','pay_status','authority'

    ];

    protected $table = 'order';

}
