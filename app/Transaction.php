<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'resource_id', 'returned_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
	    'student_id' => 'int',
	    'resource_id' => 'int',
    ];

    protected $dates = ['created_at', 'updated_at', 'returned_at'];

    /**
     * A transaction belongs to a student.
     *
     * @var array
     */
    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    /**
     * A transaction belongs to a resource.
     *
     * @var array
     */
    public function resource()
    {
    	return $this->belongsTo('App\Resource');
    }
}
