<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Topic\TopicRepository;
use App\Repositories\Word\WordRepository;
use Dotenv\Parser\Lexer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class LessonAdminController extends Controller
{
    protected $courseRepo;
    protected $lessonRepo;
    protected $wordRepo;
    protected $categoryRepo;
    protected $topicRepo;

    public function __construct(
        CourseRepository $courseRepo,
        LessonRepository $lessonRepo,
        WordRepository $wordRepo,
        CategoryRepository $categoryRepo,
        TopicRepository $topicRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->lessonRepo = $lessonRepo;
        $this->wordRepo = $wordRepo;
        $this->categoryRepo = $categoryRepo;
        $this->topicRepo = $topicRepo;
    }

    public function index()
    {
        $lessons = $this->lessonRepo->getByPaginate(Config::get('variable.paginate_lesson'));
        $courses = $this->courseRepo->getAll();
        $words = $this->wordRepo->getOrderBy('vocabulary', 'asc');

        foreach ($words as $word) {
            $word->category_name = $this->categoryRepo->find($word->category_id)->name;
        }

        foreach ($courses as $course) {
            $course->topic_name = $this->topicRepo->find($course->topic_id)->name;
        }

        return view('auth.admin.lessons', compact('lessons', 'courses', 'words'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $requestLesson = ['name' => $data['name'], 'described' => $data['described'], 'course_id' => $data['course_id']];
        try {
            $lesson = $this->lessonRepo->create($requestLesson);

            foreach ($data as $key => $value) {
                if (Str::contains($key, 'option')) {
                    $this->wordRepo->setColumnLessonID($value, $lesson->id);
                }
            }
    
            return redirect()->route('lessons.index')->with('status', trans('insert_success_lesson'));
        } catch (\Throwable $th) {

            return redirect()->route('lessons.index')->with('status', trans('insert_fail_lesson'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Lesson $lesson, Request $request)
    {
        $data = $request->all();
        if ($this->lessonRepo->update($lesson, $data)) {
            foreach ($data as $key => $value) {
                if (Str::contains($key, 'option')) {
                    $this->wordRepo->setColumnLessonID($value, $lesson->id);
                }
            }

            return redirect()->route('lessons.index')->with('status', trans('update_success_lesson'));
        } else {

            return redirect()->route('lessons.index')->with('status', trans('update_faile_lesson'));
        }
    }

    public function removeWord(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (Str::contains($key, 'option')) {
                $this->wordRepo->setColumnLessonID($value);
            }
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $words = $this->wordRepo->getByLessonID($lesson->id);
        if ($this->lessonRepo->delete($lesson)){
            foreach($words as $word){
                $this->wordRepo->setColumnLessonID($word->id);
            }
            
            return redirect()->route('lessons.index')->with('status', trans('delete_success_lesson'));
        }
        else{

            return redirect()->route('lessons.index')->with('status', trans('delete_fail_lesson'));
        }
    }
}
