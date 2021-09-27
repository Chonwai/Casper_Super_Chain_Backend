<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
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
        'requester_id',
        'addressee_id',
        'status',
        'last_read_message_id',
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
     * Scope a query to only include followed status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFollowed($query)
    {
        return $query->where('status', 'followed');
    }

    /**
     * Get the user that owns the request.
     * 
     * @return object
     */
    public function requester()
    {
        return $this->belongsTo(Users::class, 'requester_id', 'id');
    }

    /**
     * Get the user that owns the address.
     * 
     * @return object
     */
    public function addressee()
    {
        return $this->belongsTo(Users::class, 'addressee_id', 'id');
    }
}
