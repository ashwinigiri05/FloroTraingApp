<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use App\Models\UserActivity;
use App\Models\AuthenticationLog;


class User extends Authenticatable
{   use HasApiTokens;
    use Notifiable;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email', 'password','firstname', 'lastname','contact_number','address','house_number','postal_code','city',
        'remember_token','created_at','updated_at',
    ];
   
    public $sortable = ['username', 'firstname', 'lastname', 'email','created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userHistory()
    {
        return $this->MorphMany(UserActivity::class, 'entity')->with('modifiedBy')
            ->orderBy('updated_at', 'desc');
    }

    public function userLastLoginDetails()
    {
        return $this->hasMany(AuthenticationLog::class)->orderBy('created_at', 'desc')->limit(1);
    }
}
