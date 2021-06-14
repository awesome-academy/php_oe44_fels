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
use Illuminate\Http\Request;

class WordAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::orderBy('id', 'desc')->get();
        foreach($words as $word){
            $word->category_name = Category::find($word->category_id)->name;
            $word->lesson_name = $word->lesson_id ? Lesson::find($word->lesson_id)->name : '';
            $word->course_name = $word->lesson_id ? Course::find(Lesson::find($word->lesson_id)->course_id)->name : '';
            $word->topic_name = $word->lesson_id ? Topic::find(Course::find(Lesson::find($word->lesson_id)->course_id)->topic_id)->name : '';
        }
        $categories = Category::all();

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

        $word =  new Word();
        $word->vocabulary = $request->get('vocabulary');
        $word->translate = $request->get('translate');
        $word->spelling = $request->get('spelling');
        $word->category_id = $request->get('category_id');

        if (!$word->save()) {

            return back()->withInput()->with('status', trans('insert_fail_word'));
        }
        
        new QuestionsController($word);
        $endsQuestionsID = Question::count();
        $range = [$endsQuestionsID, $endsQuestionsID - 1 , $endsQuestionsID - 2];
        $word->range_questions = implode(',', $range);
        $word->save();

        return back()->withInput()->with('status', trans('insert_success_word'));
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
        $word = Word::find($id);
        $word->vocabulary = $request->get('vocabulary');
        $word->translate = $request->get('translate');
        $word->spelling = $request->get('spelling');
        $word->category_id = $request->get('category_id');

        if (!$word->save()) {

            return back()->withInput()->with('status', trans('update_faile_word'));
        }
        // delete all old questions of this word
        $range_question = explode(',', $word->range_questions);
        Question::destroy($range_question);

        // insert again new questions of this word
        new QuestionsController($word);
        $endsQuestionsID = Question::count();
        $range = [$endsQuestionsID, $endsQuestionsID - 1 , $endsQuestionsID - 2];
        $word->range_questions = implode(',', $range);
        $word->save();

        return back()->withInput()->with('status', trans('update_success_word'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::find($id);
        $range_question = explode(',', $word->range_questions);
        if (!$word->delete()) {

            return back()->withInput()->with('status', trans('delete_faile_course'));
        }

        Question::destroy($range_question);

        return back()->withInput()->with('status', trans('delete_success_course'));

    }
}
