<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    public function index()
    {
        return view('layouts.functions.seeWord');
    }

    public function filter($option)
    {
        $dataWords = DB::table('words')
            ->join('lessons', 'lessons.id', '=', 'words.lesson_id')
            ->join('user_courses', 'user_courses.course_id', '=', 'lessons.course_id')
            ->where('user_courses.user_id', '=', Auth::user()->id)
            ->get();

        $data = [];
        foreach ($dataWords as $item) {
            $categoryName = Category::find($item->category_id)->name;
            array_push($data, array('vocabulary' => $item->vocabulary, 'translate' => $item->translate, 'category_id' => $item->category_id, 'category_name' => $categoryName));
        }

        if ($option == Config::get('variable.filter_by_alphabet')) { // show filter alphabet
            $dataFilterAlphabet = array_values(Arr::sort($data, function ($value) {
                return $value['vocabulary'];
            }));

            return [
                'data' => $dataFilterAlphabet,
            ];
        } else if ($option == Config::get('variable.filter_by_type')) {  // show filter type
            $dataFilterCategory = array_values(Arr::sort($data, function ($value) {

                return $value['category_id'];
            }));

            return [
                'data' => $dataFilterCategory,
            ];
        } else if ($option == Config::get('variable.filter_by_learned')) { // show filter learned
            $dataFilterLearned = Auth::user()->learned_word_list;
            $dataFilterLearned = Str::of($dataFilterLearned)->explode(',');
            $dataFilterLearned = Arr::sort($dataFilterLearned);

            $dataWordsLearned = [];
            foreach ($dataFilterLearned as $item) {
                foreach ($data as $key => $value) {
                    if ($item == $value['vocabulary']) {
                        array_push($dataWordsLearned, $data[$key]);
                    }
                }
            }

            return [
                'data' => $dataWordsLearned,
            ];
        } else if ($option == Config::get('variable.filter_by_unlearned')) { // show filter unlearned
            $dataFilterLearned = Auth::user()->learned_word_list;
            $dataFilterLearned = explode(',', $dataFilterLearned);
            $dataWordsUnLearned = [];

            foreach ($data as $key => $value) {
                if (!in_array($value['vocabulary'], $dataFilterLearned)) {
                    array_push($dataWordsUnLearned, $data[$key]);
                }
            }

            return [
                'data' => $dataWordsUnLearned,
            ];
        } else { // show all

            return [
                'data' => $data,
            ];
        }
    }

    public function search($char)
    {
        $dataWords = DB::table('words')
            ->join('lessons', 'lessons.id', '=', 'words.lesson_id')
            ->join('user_courses', 'user_courses.course_id', '=', 'lessons.course_id')
            ->where('user_courses.user_id', '=', Auth::user()->id)
            ->get();

        $data = [];
        foreach ($dataWords as $item) {
            $voc = strtolower($item->vocabulary);
            $tran = strtolower($item->translate);
            $ch = strtolower($char);
            if ($ch != '' && Str::of($voc)->contains([Str::lower($ch), Str::upper($ch)]) || Str::of($tran)->contains([Str::lower($ch), Str::upper($ch)])) {
                $categoryName = Category::find($item->category_id)->name;
                array_push($data, array('voc' => $voc, 'ch' => $ch, 'vocabulary' => $item->vocabulary, 'translate' => $item->translate, 'category_id' => $item->category_id, 'category_name' => $categoryName));
            }
        }

        return [
            'data' => $data,
        ];
    }
}
