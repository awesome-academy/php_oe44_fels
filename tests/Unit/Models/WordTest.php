<?php

namespace Tests\Unit\Models;

use App\Models\Word;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Tests\TestCase;

class WordTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->word = new Word();
        $this->initial = [
            'vocabulary' => 'Hello',
            'translate' => 'Xin chào',
            'spelling' => 'həˈlō',
            'category_id' => 1,
            'lesson_id' => 2,
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['vocabulary','translate','spelling','category_id','lesson_id',], $this->word->getFillable());
    }

    public function test_word_relations()
    {
        $relation_with_category = $this->word->categories();
        $relation_with_lesson = $this->word->lessons();
        $relation_with_question = $this->word->questions();

        $this->assertInstanceOf(BelongsTo::class, $relation_with_category);
        $this->assertEquals('id', $relation_with_category->getOwnerKeyName());
        $this->assertEquals('categories_id', $relation_with_category->getForeignKeyName());

        $this->assertInstanceOf(BelongsTo::class, $relation_with_lesson);
        $this->assertEquals('id', $relation_with_lesson->getOwnerKeyName());
        $this->assertEquals('lessons_id', $relation_with_lesson->getForeignKeyName());

        $this->assertInstanceOf(HasMany::class, $relation_with_question);
        $this->assertEquals('questions.word_id', $relation_with_question->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        word::unguard();
        $word = new word($this->initial);
        $this->assertSame($this->initial, $word->attributesToArray());
    }

    public function test_word_getter()
    {
        $this->word->setAttribute('vocabulary', 'hello');
        $this->word->setAttribute('translate', 'Xin chào');

        $this->assertEquals('hello', $this->word->getAttribute('vocabulary'));
        $this->assertEquals('Xin chào', $this->word->getAttribute('translate'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['vocabulary']));
        $this->assertEquals('string', gettype($this->initial['translate']));
        $this->assertEquals('string', gettype($this->initial['spelling']));
        $this->assertEquals('integer', gettype($this->initial['category_id']));
        $this->assertEquals('integer', gettype($this->initial['lesson_id']));
    }
}
