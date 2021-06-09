<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CourseAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses = Course::simplePaginate(Config::get('variable.paginate_course'));
        $topics = Topic::all();

        return view('auth.admin.courses', compact(['courses','topics']));
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
        $course =  new Course();
        $course->name = $request->get('name');
        $course->described = $request->get('described');
        $course->topic_id = $request->get('topic_id');
        if (!$course->save()) {

            return back()->withInput()->with('status', trans('insert_fail_course'));
        }
        
        return back()->withInput()->with('status', trans('insert_success_course'));
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
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->name = $request->get('name');
        $course->topic_id = $request->get('topic_id');
        $course->described = $request->get('described');

        if (!$course->save()) {

            return back()->withInput()->with('status', trans('update_faile_course'));
        }
        
        return back()->withInput()->with('status', trans('update_success_course'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course->delete()) {

            return back()->withInput()->with('status', trans('delete_faile_course'));
        }
        
        return back()->withInput()->with('status', trans('delete_success_course'));

    }
}
