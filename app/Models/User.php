<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, HasRoles, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'provider',
        'provider_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        if ($this->provider && !$this->avatar) {
            return 'img/avatar/no_avatar.jpg';
        }
        if ($this->provider && $this->avatar) {
            return $this->avatar;
        }
        if (is_null($this->avatar)) {
            return 'img/avatar/no_avatar.jpg';
        }
        return 'img/avatar/' . $this->id . '/' . $this->avatar;
    }


    function hasEmailVerified()
    {
        if (is_null($this->email_verified_at)) {
            return true;
        } else {
            return false;
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id')->whereHas('itemsFilter', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->orderByDesc('created_at');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'user_id')->where('status', 1)->orderByDesc('created_at');
    }
}
