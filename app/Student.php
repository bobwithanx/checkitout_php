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

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function transactions_current()
    {
        return $this->hasMany('App\Transaction')->current();
    }

    public function open_transactions()
    {
        return $this->hasMany('App\Transaction')->current();
    }

    public function transactionsCountRelation()
    {
        return $this->hasOne('App\Transaction')->selectRaw('id, count(*) as count')->groupBy('id');
    // replace module_id with appropriate foreign key if needed
    }

    public function getTransactionsCountAttribute()
    {
        return $this->transactionsCountRelation?$this->transactionsCountRelation->count:0;
    }

    public function openTransactionsCountRelation()
    {
        return $this->hasOne('App\Transaction')->current()->selectRaw('id, count(*) as count')->groupBy('id');
    // replace module_id with appropriate foreign key if needed
    }

    public function getOpenTransactionsCountAttribute()
    {
        return $this->openTransactionsCountRelation?$this->openTransactionsCountRelation->count:0;
    }

    public function openTransactionsCount()
    {
      return $this->open_transactions()
      ->selectRaw('id, count(*) as aggregate')
      ->groupBy('id');
  }

}