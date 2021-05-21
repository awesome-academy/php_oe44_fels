<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function lessons()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
