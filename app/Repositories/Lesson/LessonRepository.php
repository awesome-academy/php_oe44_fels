<?php
namespace App\Repositories\Lesson;

use App\Models\Lesson;
use App\Repositories\BaseRepository;

class LessonRepository extends BaseRepository
{
    public function getModel()
    {
        return Lesson::class;
    }
}
