<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    private $monOfYear = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    public function userRegister($year)
    {
        $users = User::select(DB::raw("COUNT(*) as count, month(created_at) as month"))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("Month(created_at)"))->get();

        $userData = array_fill_keys($this->monOfYear, 0);
        foreach ($users as $user) {
            $userData[$user->month] = $user->count;
        }

        return $userData;
    }

    public function topicOfMonth($month, $year)
    {
        $topicDataOfMonth = DB::table('user_topics')->select(DB::raw('topics.name as name, COUNT(user_topics.id) as count'))
            ->join('topics', 'user_topics.topic_id', '=', 'topics.id')
            ->whereYear('user_topics.created_at', $year)
            ->whereMonth('user_topics.created_at', $month)
            ->groupBy('name')->get();

        return $topicDataOfMonth;
    }

    public function topicOfYear($year)
    {
        $topicDataOfYear= DB::table('user_topics')->select(DB::raw('topics.name as name, COUNT(user_topics.id) as count'))
            ->join('topics', 'user_topics.topic_id', '=', 'topics.id')
            ->whereYear('user_topics.created_at', $year)
            ->groupBy('name')->get();

        return $topicDataOfYear;
    }

    public function courseRegister($month, $year)
    {
        $courseDataOfMonth = DB::table('user_courses')->select(DB::raw('courses.name as name , COUNT(user_courses.id) as count'))
        ->join('courses', 'user_courses.course_id', '=', 'courses.id')
        ->whereYear('user_courses.created_at', $year)
        ->whereMonth('user_courses.created_at', $month)
        ->groupBy('name')->get();

        return $courseDataOfMonth;
    }
}
