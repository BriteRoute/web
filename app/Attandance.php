<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    protected $table = 'attandance';  

    protected $fillable = [
        'user_id',
        'course_id',
        'instructor_id',
        'order_id',
        'date',
        'end_date',
        'status'
    ];
}
