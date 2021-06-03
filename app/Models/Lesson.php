<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class,'user_lessons')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

}
