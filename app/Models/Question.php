<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'option_1',
        'option_2',
        'option_3',
        'correct_answer',
        'word_id',
    ];

    public function words()
    {
        return $this->belongsTo(Word::class);
    }
}
