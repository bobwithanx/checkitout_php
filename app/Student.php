<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'id_number'];

    protected $dates = ['deleted_at'];

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the tags associated with this user.
     *
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public static function findByStudentId($id_number)
    {
        return Student::where('id_number', $id_number)->first();
    }

    public function loans()
    {
        return $this->hasMany('App\Loan');
    }

    public function loans_current()
    {
        return $this->hasMany('App\Loan')->current();
    }

    public function open_loans()
    {
        return $this->hasMany('App\Loan')->current();
    }

    public function loansCountRelation()
    {
        return $this->hasOne('App\Loan')->selectRaw('id, count(*) as count')->groupBy('id');
    // replace module_id with appropriate foreign key if needed
    }

    public function getLoansCountAttribute()
    {
        return $this->loansCountRelation?$this->loansCountRelation->count:0;
    }

    public function openLoansCountRelation()
    {
        return $this->hasOne('App\Loan')->current()->selectRaw('id, count(*) as count')->groupBy('id');
    // replace module_id with appropriate foreign key if needed
    }

    public function getOpenLoansCountAttribute()
    {
        return $this->openLoansCountRelation?$this->openLoansCountRelation->count:0;
    }

    public function openLoansCount()
    {
      return $this->open_loans()
      ->selectRaw('id, count(*) as aggregate')
      ->groupBy('id');
  }

}