<?php

namespace Tests\Unit\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class LessonTest extends TestCase
{
     
    public function setUp() : void
    {
        parent::setUp();
        $this->lesson = new Lesson();
        $this->initial = [
            'name' => 'Lesson One',
            'described' => 'Nothing...',
            'course_id' => 1,
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['name', 'described', 'course_id'], $this->lesson->getFillable());
    }

    public function test_lesson_relations()
    {
        $relation_with_user = $this->lesson->users();
        $relation_with_course = $this->lesson->courses();
        $relation_with_word = $this->lesson->words();

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_user);
        $this->assertEquals('user_lessons', $relation_with_user->getTable());
        $this->assertEquals('user_lessons.lesson_id', $relation_with_user->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_lessons.user_id', $relation_with_user->getQualifiedRelatedPivotKeyName());

        $this->assertInstanceOf(BelongsTo::class, $relation_with_course);
        $this->assertEquals('id', $relation_with_course->getOwnerKeyName());
        $this->assertEquals('courses_id', $relation_with_course->getForeignKeyName());

        $this->assertInstanceOf(HasMany::class, $relation_with_word);
        $this->assertEquals('words.lesson_id', $relation_with_word->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        lesson::unguard();
        $lesson = new lesson($this->initial);
        $this->assertSame($this->initial, $lesson->attributesToArray());
    }

    public function test_lesson_getter()
    {
        $this->lesson->setAttribute('name', 'Lesson Two');
        $this->assertEquals('Lesson Two', $this->lesson->getAttribute('name'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['name']));
        $this->assertEquals('string', gettype($this->initial['described']));
        $this->assertEquals('integer', gettype($this->initial['course_id']));
    }
}
