<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'id_number', 'group_id', 'grade_level_id', 'is_active'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'group_id' => 'int',
        'grade_level_id' => 'int',
        'is_active' => 'bool',
    ];

    /**
     * A resource belongs to a category.
     *
     * @var array
     */
    public function group()
    {
      return $this->belongsTo('App\Group');
    }

    /**
     * A resource belongs to a category.
     *
     * @var array
     */
    public function grade_level()
    {
      return $this->belongsTo('App\GradeLevel');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

}