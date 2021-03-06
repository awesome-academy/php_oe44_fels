<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Topic\TopicRepository;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CourseAdminController extends Controller
{
    protected $courseRepo;
    protected $topicRepo;

    public function __construct(CourseRepository $courseRepo, TopicRepository $topicRepo) {
        $this->courseRepo = $courseRepo;
        $this->topicRepo = $topicRepo;
    }

    public function index()
    {
        $courses = $this->courseRepo->getByPaginate(Config::get('variable.paginate_course'));
        $topics = $this->topicRepo->getAll();

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
            $this->courseRepo->create($request->all());

            return redirect()->route('courses.index')->with('status', trans('insert_success_course'));
        } catch (\Throwable $th) {

            return redirect()->route('courses.index')->with('status', trans('insert_fail_course'));
        }
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
    public function update(Course $course, Request $request)
    {
        if($this->courseRepo->update($course, $request->all())){

            return redirect()->route('courses.index')->with('status', trans('update_success_course'));
        }
        else{

            return redirect()->route('courses.index')->with('status', trans('update_fail_course'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        
        if ($this->courseRepo->delete($course)){

            return redirect()->route('courses.index')->with('status', trans('delete_success_course'));
        }
        else{

            return redirect()->route('courses.index')->with('status', trans('delete_fail_course'));
        }

    }
}
