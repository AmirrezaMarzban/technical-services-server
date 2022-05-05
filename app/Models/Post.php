<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'p_c',
        'cooperation_id',
        'pmethod_id',
        'workinghours_id',
        'working_experiences_id',
        'insurance',
        'remote',
        'military_service',
        'view',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at'  => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function workingExperiences() {
        return $this->belongsTo(WorkingExperiences::class);
    }

    public function cooperation() {
        return $this->belongsTo(Cooperation::class);
    }

    public function pmethod() {
        return $this->belongsTo(PMethods::class);
    }

    public function workinghours() {
        return $this->belongsTo(Workinghours::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, "post_user");
    }

    public function provinceId() {
        return Province::where('name', explode(' / ', $this->p_c)[0])->id;
    }

    public function cityId() {
        return City::where('name', explode(' / ', $this->p_c)[1])->id;
    }
}
