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
        $transactions = $this->transactions()->whereNull('transactions.returned_at');
        if ($transactions) {
            return $transactions;
        }
        else {
            return 0;
        }
    }

    public function transactions_history()
    {
        $transactions = $this->transactions()->whereNotNull('transactions.returned_at')
            ->orderBy('returned_at', 'DESC');
        if ($transactions) {
            return $transactions;
        }
        else {
            return 0;
        }
    }

}