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
        return $this->belongsTo(Room::class);
    }

    public function borrower()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function admin()
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Accessor
     */


    /**
     * Mutators
     */
}
