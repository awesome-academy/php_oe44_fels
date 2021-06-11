<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Topic;
use App\Models\Word;
use Dotenv\Parser\Lexer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class LessonAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::simplePaginate(Config::get('variable.paginate_lesson'));
        $courses = Course::all();
        $words = Word::orderBy('vocabulary', 'asc')->get();

        foreach ($words as $word) {
            $word->category_name = Category::find($word->category_id)->name;
        }

        foreach ($courses as $course) {
            $course->topic_name = Topic::find($course->topic_id)->name;
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
        $lesson = new Lesson();
        $lesson->name = $data['name'];
        $lesson->described = $data['described'];
        $lesson->course_id = $data['course_id'];

        if (!$lesson->save()) {

            return back()->withInput()->with('status', trans('insert_fail_lesson'));
        }

        foreach ($data as $key => $value) {
            if (Str::contains($key, 'option')) {
                $word = Word::find($value);
                $word->lesson_id = $lesson->id;
                $word->save();
            }
        }

        return back()->withInput()->with('status', trans('insert_success_lesson'));
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $lesson = new Lesson();
        $lesson->name = $data['name'];
        $lesson->course_id = $data['course_id'];
        $lesson->described = $data['described'];

        if (!$lesson->save()) {

            return back()->withInput()->with('status', trans('update_faile_lesson'));
        }

        foreach ($data as $key => $value) {
            if (Str::contains($key, 'option')) {
                $word = Word::find($value);
                $word->lesson_id = $id;
                $word->save();
            }
        }

        return back()->withInput()->with('status', trans('update_success_lesson'));
    }

    public function removeWord(Request $request, $id)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (Str::contains($key, 'option')) {
                $word = Word::find($value);
                $word->lesson_id = null;
                $word->save();
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
    public function destroy($id)
    {
        $words = Word::where('lesson_id', $id)->get();

        $lesson = Lesson::find($id);
        if (!$lesson->delete()) {

            return back()->withInput()->with('status', trans('delete_faile_lesson'));
        }

        foreach ($words as $word) {
            $word->lesson_id = null;
            $word->save();
        }

        return back()->withInput()->with('status', trans('delete_success_lesson'));
    }
}
