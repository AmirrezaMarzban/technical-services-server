<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingExperiences extends Model
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
