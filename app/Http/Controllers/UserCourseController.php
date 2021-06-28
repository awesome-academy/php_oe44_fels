<?php

namespace App\Http\Controllers;

use App\Events\SendAdminNotificationUserRegisted;
use App\Models\Course;
use App\Models\User_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserCourseController extends Controller
{
    public function insert($course_id)
    {
        $user_id = Auth::user()->id;

        $user_course = new User_Course();
        $user_course->user_id = $user_id;
        $user_course->course_id = $course_id;
        $user_course->status = 0;

        $user_course->save();

        event(new SendAdminNotificationUserRegisted(Auth::user()->email, Course::find($course_id), Config::get('variable.notifi_user_course')));

        return redirect()->back();
    }
}
