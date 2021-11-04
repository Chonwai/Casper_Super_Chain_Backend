<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUsers extends Model
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
        'room_id',
        'user_id',
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
     * Get the room.
     * 
     * @return object
     */
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'id');
    }

    /**
     * Get the user that is a room member.
     * 
     * @return object
     */
    public function member()
    {
        return $this->hasMany(Users::class, 'id', 'user_id');
    }
}
