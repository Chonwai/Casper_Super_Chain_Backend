<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
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
        'created_by',
        'ordered_by',
        'status',
        'remark',
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
    public function creator()
    {
        return $this->belongsTo(Users::class, 'created_by', 'id');
    }

    /**
     * Get the user that owns the request.
     * 
     * @return object
     */
    public function orderer()
    {
        return $this->belongsTo(Users::class, 'ordered_by', 'id');
    }

    /**
     * Get the user that owns the request.
     * 
     * @return object
     */
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
