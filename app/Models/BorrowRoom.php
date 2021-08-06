<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowRoom extends Model
{
    use SoftDeletes;

    protected $table = 'borrow_rooms';

    /**
     * Relationship
     */
    public function room()
    {
        $this->belongsTo(Room::class);
    }
}
