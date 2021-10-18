<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
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
        'follow_id',
        'sender_id',
        'recipient_id',
        'content',
        'message_type',
        'is_read',
        'read_at',
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
    public function sender()
    {
        return $this->belongsTo(Users::class, 'sender_id', 'id');
    }

    /**
     * Get the user that owns the request.
     * 
     * @return object
     */
    public function recipient()
    {
        return $this->belongsTo(Users::class, 'recipient_id', 'id');
    }
}
