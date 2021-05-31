<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $topics = Topic::all();
        $user_topics = DB::table('user_topics')->where('user_id', "=", $user->id)->pluck('topic_id');
        $user_course = DB::table('user_courses')->where('user_id', "=", $user->id)->get();

        $listCourseByTopic = [];
        foreach($user_topics as $item){
            $course_topic = DB::table('courses')->where('topic_id', '=', $item)->get();
            array_push($listCourseByTopic,$course_topic);
        }
        
        return view('layouts.functions.seeOtherCourse', compact(['listCourseByTopic', 'topics', 'user_course']));
    }
}
