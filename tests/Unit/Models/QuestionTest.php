<?php

namespace Tests\Unit\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class QuestionTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->question = new Question();
        $this->initial = [
            'question' => 'What did you know mean this word "Database"?, Chosse an answer correct.',
            'option_1' => 'Dữ liệu',
            'option_2' => 'Cơ sở dữ liệu',
            'option_3' => 'Lưu trữ',
            'correct_answer' => 'Cơ sở dữ liệu',
            'word_id' => 1,
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['question', 'option_1', 'option_2', 'option_3', 'correct_answer', 'word_id'], $this->question->getFillable());
    }

    public function test_question_relations()
    {
        $relation_with_word = $this->question->words();
        
        $this->assertInstanceOf(BelongsTo::class, $relation_with_word);
        $this->assertEquals('id', $relation_with_word->getOwnerKeyName());
        $this->assertEquals('words_id', $relation_with_word->getForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        question::unguard();
        $question = new question($this->initial);
        $this->assertSame($this->initial, $question->attributesToArray());
    }

    public function test_question_getter()
    {
        $this->question->setAttribute('option_1', 'Data');
        $this->assertEquals('Data', $this->question->getAttribute('option_1'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['question']));
        $this->assertEquals('string', gettype($this->initial['option_1']));
        $this->assertEquals('string', gettype($this->initial['option_2']));
        $this->assertEquals('string', gettype($this->initial['option_3']));
        $this->assertEquals('string', gettype($this->initial['correct_answer']));
        $this->assertEquals('integer', gettype($this->initial['word_id']));
    }
}
