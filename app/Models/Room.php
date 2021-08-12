<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $tables = 'rooms';

    /**
     * Relationship
     */
    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function borrow_rooms()
    {
        return $this->hasMany(BorrowRoom::class);
    }
}
