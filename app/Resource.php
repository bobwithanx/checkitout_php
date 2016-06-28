<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'inventory_tag', 'category_id', 'serial_number'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'is_active' => 'bool',
    ];

    /**
     * A resource belongs to a category.
     *
     * @var array
     */
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function is_available()
    {
        return $this->transactions->count() == 0;
    }
}
