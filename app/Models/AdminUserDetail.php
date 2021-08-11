<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserDetail extends Model
{
    use HasFactory;

    /**
     * tables
     *
     * @var string
     */
    protected $tables = 'admin_user_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id',
        'data',
    ];

    /**
     * user
     *
     * @return void
     */
    public function admin_user()
    {
        $this->belongsTo(Administrator::class);
    }
}
