<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class,'user_topics')->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
