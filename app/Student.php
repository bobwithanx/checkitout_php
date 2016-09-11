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


}