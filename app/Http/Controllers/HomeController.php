<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use App\Models\User_Course;
use App\Models\User_Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $topics = Topic::all();
        $user_topics = DB::table('user_topics')->where('user_id', "=", $user->id)->pluck('topic_id');
        $user_courses = DB::table('user_courses')->where('user_id', "=", $user->id)->pluck('course_id');
        
        $listMyCourse = [];
        $lessonOfMyCourse = [];

        foreach($user_courses as $key=>$value){
            $course = DB::table('courses')->where('id', '=', $value)->get();
            $lesson = DB::table('lessons')->where('course_id', '=', $value)->get();
            array_push($listMyCourse,$course);
            array_push($lessonOfMyCourse,$lesson);
        }
        
        return view('home',compact(['user_topics','user_courses','topics','listMyCourse','lessonOfMyCourse']));
    }
}
