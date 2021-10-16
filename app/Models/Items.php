<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'price',
        'storage_quantity',
        'available_quantity',
        'reserved_quantity',
        'product_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the request.
     * 
     * @return object
     */
    public function provider()
    {
        return $this->belongsTo(Users::class, 'provider_id', 'id');
    }

    /**
     * Scope a query to only include has stock status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasStock($query)
    {
        return $query->where('storage_quantity', '>=', 0);
    }

    /**
     * Scope a query to only include no stock status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNoStock($query)
    {
        return $query->where('storage_quantity', '==', 0);
    }

    /**
     * Scope a query to only include has available stock status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasAvailableStock($query)
    {
        return $query->where('available_quantity', '>=', 0);
    }

    /**
     * Scope a query to only include no available stock status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNoAvailableStock($query)
    {
        return $query->where('available_quantity', '==', 0);
    }
}
