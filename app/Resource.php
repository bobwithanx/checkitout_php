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
    protected $fillable = ['name', 'inventory_tag', 'category_id', 'serial_number', 'is_available'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'is_available' => 'bool',
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

    public static function findByInventoryTag($tag)
    {
        return Resource::where('inventory_tag', $tag)->first();
    }

    public static function findBySerialNumber($sn)
    {
        return Resource::where('serial_number', $sn)->first();
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeOnLoan($query)
    {
        return $query
            ->where('is_available', false);
    }

    public function isAvailable()
    {
        return $this->is_available;
    }
}
