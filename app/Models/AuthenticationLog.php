<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AuthenticationLog extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'user_id','login_time','logout_time','browser_agent', 'ip_address',
    ];
}
