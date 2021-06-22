<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\QuestionsController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Word;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Course\CourseRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Topic\TopicRepository;
use App\Repositories\Word\WordRepository;
use Illuminate\Http\Request;

class WordAdminController extends Controller
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

        $words = $this->wordRepo->getOrderBy('id', 'desc');
        foreach ($words as $word) {
            $word->category_name = $this->categoryRepo->find($word->category_id)->name;
            $word->lesson_name = $word->lesson_id ? $this->lessonRepo->find($word->lesson_id)->name : '';
            $word->course_name = $word->lesson_id ? $this->courseRepo->find($this->lessonRepo->find($word->lesson_id)->course_id)->name : '';
            $word->topic_name = $word->lesson_id ? $this->topicRepo->find($this->courseRepo->find($this->lessonRepo->find($word->lesson_id)->course_id)->topic_id)->name : '';
        }
        $categories = $this->categoryRepo->getAll();

        return view('auth.admin.words', compact(['words', 'categories']));
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
            $word = $this->wordRepo->create($request->all());
            $this->wordRepo->createQuestionsForWord($word);

            return redirect()->route('words.index')->with('status', trans('insert_success_word'));
        } catch (\Throwable $th) {

            return redirect()->route('words.index')->with('status', trans('insert_fail_word'));
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
    public function update(Word $word, Request $request)
    {
        if ($this->wordRepo->update($word, $request->all())) {
            // delete all old questions of this word
            $this->wordRepo->deleteQuestionsForWord($word);

            // insert again new questions of this word
            $this->wordRepo->createQuestionsForWord($word);

            return back()->withInput()->with('status', trans('update_success_word'));
        }

        return back()->withInput()->with('status', trans('update_faile_word'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $range_question = explode(',', $word->range_questions);
        if ($this->wordRepo->delete($word)) {
            Question::destroy($range_question);

            return back()->withInput()->with('status', trans('delete_success_course'));
        } else {

            return back()->withInput()->with('status', trans('delete_faile_course'));
        }
    }
}
