<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workinghours extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
