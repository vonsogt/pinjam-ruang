<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowRoom extends Model
{
    use SoftDeletes;

    protected $table = 'borrow_rooms';
}
