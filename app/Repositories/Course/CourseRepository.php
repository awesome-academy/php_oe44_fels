<?php
namespace App\Repositories\Course;

use App\Models\Course;
use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository
{
    public function getModel()
    {
        return Course::class;
    }
}
