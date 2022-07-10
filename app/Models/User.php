<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'city_id',
        'province_id',
        'phone_verified',
        'phone_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function activationCode() {
        return $this->hasMany(ActivationCode::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function recentPosts() {
        return $this->belongsToMany(Post::class, 'post_user');
    }

    public function p_c() {
        return Province::where('id', $this->province_id)->first()->name . ' / ' . City::where('id', $this->city_id)->first()->name;
    }

    public function province() {
        return $this->belongsTo(Province::class);
    }
    public function city() {
        return City::where('id', $this->city_id)->first()->name;
    }
}
