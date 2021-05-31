<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User_Course;
use App\Models\User_Lesson;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLessonController extends Controller
{
    public function index($course_id)
    {
        $lessons = Lesson::with('courses')->where('course_id', '=', $course_id)->get();
        $course = Course::find($course_id)->first();

        $courseItems = [];
        foreach ($lessons as $lesson) {
            array_push($courseItems, $lesson);
        }
        $listLesson = array('course' => $course, 'lessons' => $courseItems);

        return view('layouts.functions.lessons')->with('listLesson', $listLesson);
    }

    public function start($lesson_id)
    {
        $words = Word::where('lesson_id', '=', $lesson_id)->get();
        $lesson = Lesson::find($lesson_id);
        if ($lesson) {
            $user_course  = User_Course::where([['user_id', Auth::user()->id], ['course_id', $lesson->course_id]])->first();
            if ($user_course) {
                $user_lesson = User_Lesson::where([['user_id', Auth::user()->id], ['lesson_id', $lesson_id]])->first();

                if (!$user_lesson) {
                    $dataUserLesson = array(
                        'user_id' => Auth::user()->id,
                        'lesson_id' => $lesson_id,
                        'result' => null,
                        'status' => 0,
                    );

                    DB::table('user_lessons')->insert($dataUserLesson);
                }
            } else {

                return redirect()->route('home')->with('status', trans('LessonNotExist'));
            }
        } else {
            
            abort(404);
        }

        return view('layouts.functions.lesson', compact('words', 'lesson'));
    }
}
