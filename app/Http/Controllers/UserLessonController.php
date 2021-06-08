<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\User;
use App\Models\User_Course;
use App\Models\User_Lesson;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JsonException;

class UserLessonController extends Controller
{
    public function index($course_id)
    {
        $lessons = Lesson::where('course_id', '=', $course_id)->get();
        $course = Course::find($course_id)->first();
        $userLessons = [];
        foreach ($lessons as $lesson) {
            $userLesson = User_Lesson::where([['user_id', Auth::user()->id], ['lesson_id', $lesson->id]])->first();
            array_push($userLessons, $userLesson);
        }
        $data = array('course' => $course, 'lessons' => $lessons, 'userLessons' => $userLessons);
        
        return view('layouts.functions.lessons')->with('data', $data);
    }

    public function start($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        if ($lesson) {
            $userCourse  = User_Course::where([['user_id', Auth::user()->id], ['course_id', $lesson->course_id]])->first();
            if ($userCourse) {
                $userLesson = User_Lesson::where([['user_id', Auth::user()->id], ['lesson_id', $lesson_id]])->first();

                if (!$userLesson) {
                    $dataUserLesson = array(
                        'user_id' => Auth::user()->id,
                        'lesson_id' => $lesson_id,
                        'result_string' => null,
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

        $userLesson = User_Lesson::where([['user_id', Auth::user()->id], ['lesson_id', $lesson_id]])->first();
        $course =  Course::find($lesson->course_id);
        $words = Word::where('lesson_id', '=', $lesson_id)->get();
        $categories = Category::all();
        $questions = [];
        foreach ($words as $word) {
            $question = DB::table('questions')->inRandomOrder()->where('word_id', $word->id)->first();
            array_push($questions, $question);
        }

        $data = array('course' => $course, 'lesson' => $lesson, 'words' => $words, 'categories' => $categories, 'userLesson' => $userLesson, 'questions' => $questions);

        return view('layouts.functions.lesson')->with('data', $data);
    }

    public function updateResult(Request $request)
    {
        $ressult = $request->get('result');
        $lesson_id = $request->get('lesson_id');
        $user_id = $request->get('user_id');
        $resultAccepts = $request->get('resultAccepts');
        $wordsCount = Word::where('lesson_id', $lesson_id)->count();

        $course_id = Lesson::find($lesson_id)->course_id;
    // Update result for user_lesson
        $userLesson = User_Lesson::where([['user_id', $user_id], ['lesson_id', $lesson_id]])->first();
        $userLesson->result_string = $ressult . '/' . $wordsCount;
        $userLesson->status = 1;
        $userLesson->save();

    // Update word learned for user
        $user = User::find($user_id);
        $words = $user->learned_word_list;
        $wordsOld = explode(',', $words);
        foreach($resultAccepts as $item){
            if(!Arr::has($wordsOld, $item)){
                array_push($wordsOld, $item);
            }
        }
        $user->learned_word_list = implode(',', $wordsOld);
        $user->save();

        return $course_id;
    }

    public function checkAnswer(Request $request)
    {
        $idQuestion = $request->get('id');
        $answer = $request->get('answer');

        $question = Question::find($idQuestion);

        $res = false;
        if ($answer == $question->correct_answer) {
            $res = true;
        }
        $response = ['id' => $idQuestion, 
                    'correct_answer' =>  $question->correct_answer, 
                    'message' => $res ? 'Correct' : 'Faile', 
                    'vocabulary' => Word::find($question->word_id)->vocabulary,
                ];

        return json_encode($response);
    }
}
