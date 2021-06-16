<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CourseAdminController extends Controller
{

    public function index()
    {

        $courses = Course::paginate(Config::get('variable.paginate_course'));
        $topics = Topic::all();

        return view('auth.admin.courses', compact(['courses', 'topics']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Course::create($request->all());
        } catch (\Throwable $th) {

            return redirect()->route('courses.index')->with('status', trans('insert_fail_course'));
        }

        return redirect()->route('courses.index')->with('status', trans('insert_success_course'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        try {
            $course->update($request->all());
        } catch (\Throwable $th) {

            return redirect()->route('courses.index')->with('status', trans('update_fail_course'));
        }

        return redirect()->route('courses.index')->with('status', trans('update_success_course'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
        } catch (\Throwable $th) {

            return redirect()->route('courses.index')->with('status', trans('delete_fail_course'));
        }

        return redirect()->route('courses.index')->with('status', trans('delete_success_course'));
    }
}
