<?php

namespace App\Repositories\Word;

use App\Http\Controllers\QuestionsController;
use App\Models\Question;
use App\Models\Word;
use App\Repositories\BaseRepository;

class WordRepository extends BaseRepository
{
    public function getModel()
    {
        return Word::class;
    }

    public function getOrderBy($column, $option)
    {
        return Word::orderBy($column, $option)->get();
    }

    public function getByLessonID($lesson_id)
    {
        return Word::where('lesson_id', $lesson_id)->get();
    }

    public function setColumnLessonID($word_id, $lesson_id = null)
    {
        $word = Word::find($word_id);
        $word->lesson_id = $lesson_id;
        $word->save();
    }

    public function createQuestionsForWord($word) // 3 question by 3 type
    {
        new QuestionsController($word);
        $endsQuestionsID = Question::max('id');
        $range = [$endsQuestionsID, $endsQuestionsID - 1, $endsQuestionsID - 2];
        $word->range_questions = implode(',', $range);
        $word->save();
    }

    public function deleteQuestionsForWord($word) // 3 question by 3 type
    {
        $range_question = explode(',', $word->range_questions);
        Question::destroy($range_question);
    }
}
