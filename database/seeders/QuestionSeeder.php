<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = Word::all();
        foreach($words as $word){
            $data = array(
                $this->QuestionType1($word->id, $word->vocabulary, $word->translate),
                $this->QuestionType2($word->id, $word->translate, $word->vocabulary),
                $this->QuestionType3($word->id, $word->vocabulary, $word->translate),
            );
            
            DB::table('questions')->insert($data);
        }
    }

    protected function QuestionType1($word_id, $vocabulary, $correctAns)
    {
        $listWords = Word::all();
        $words = [];
        foreach($listWords as $word){
            array_push($words, $word->translate);
        }

        $answers = [$correctAns];

        while(true){
            $answer = Arr::random($words);
            if (!in_array($answer, $answers)) {
                array_push($answers, $answer);
            }
            if(count($answers) == 3){
                break;
            }
        }

        $data = array(
            'word_id' => $word_id, 
            'question' => "Which of the following answers is correct when translating the word \"$vocabulary\" into Vietnamese?",
            'option_1' => strtolower($answers[0]),
            'option_2' => strtolower($answers[1]),
            'option_3' => strtolower($answers[2]),
            'correct_answer' => strtolower($answers[0]),
        );

        return $data;
    }

    protected function QuestionType2($word_id, $translate, $correctAns)
    {
        $listWords = Word::all();
        $words = [];
        foreach($listWords as $word){
            array_push($words, $word->vocabulary);
        }

        $answers = [$correctAns];

        while(true){
            $answer = Arr::random($words);
            if (!in_array($answer, $answers)) {
                array_push($answers, $answer);
            }
            if(count($answers) == 3){
                break;
            }
        }

        $data = array(
            'word_id' => $word_id, 
            'question' => "What does the word \"$translate\" in Vietnamese translated into English mean?",
            'option_1' => strtolower($answers[0]),
            'option_2' => strtolower($answers[1]),
            'option_3' => strtolower($answers[2]),
            'correct_answer' => strtolower($answers[0]),
        );

        return $data;
    }

    protected function QuestionType3($word_id, $vocabulary, $translate)
    {

        $randomNumberOfCharactersToCut = rand(1, Str::length($vocabulary) / 3);
        $randomStartPosition = rand(0, Str::length($vocabulary) - $randomNumberOfCharactersToCut);

        $len = $randomStartPosition + $randomNumberOfCharactersToCut;
        $correctAns = "";
        for ($i = $randomStartPosition; $i < $len; $i++) {
            $correctAns .= $vocabulary[$i];
            $vocabulary[$i] = '_';
        }

        $answers = [strtolower($correctAns)];
        while (true) {
            $res = "";
            for ($i = 0; $i < $randomNumberOfCharactersToCut; $i++) {
                $num = rand(97, 122);
                $res .= chr($num);
            }
            if (!in_array($res, $answers)) {
                array_push($answers, $res);
            }
            if (count($answers) == 3) {
                break;
            }
        }
        array_push($answers, $vocabulary);

        $data = array(
            'word_id' => $word_id, 
            'question' => "Fill in the blank \"$answers[3] \" so that when translated into Vietnamese means \"$translate\" ?",
            'option_1' => strtolower($answers[0]),
            'option_2' => strtolower($answers[1]),
            'option_3' => strtolower($answers[2]),
            'correct_answer' => strtolower($answers[0]),
        );

        return $data;
    }
}
