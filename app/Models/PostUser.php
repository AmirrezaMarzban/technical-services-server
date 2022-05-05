<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    public $table = 'post_user';
    public $timestamps = false;

    protected $fillable = [
        'post_id', 'user_id'
    ];

}
