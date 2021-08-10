<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    /**
     * tables
     *
     * @var string
     */
    protected $tables = 'user_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'data',
    ];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
