<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchCourse extends Model
{

	protected $table = 'watch_courses';
	
    protected $fillable = ['user_id', 'course_id', 'start_time', 'active'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }
}
