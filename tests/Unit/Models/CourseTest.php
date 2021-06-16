<?php

namespace Tests\Unit\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->course = new Course();
        $this->initial = [
            'name' => 'Course One',
            'described' => 'Nothing...',
            'topic_id' => 2,
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['name', 'described', 'topic_id'], $this->course->getFillable());
    }

    public function test_course_relations()
    {
        $relation_with_user = $this->course->users();
        $relation_with_lesson = $this->course->lessons();
        $relation_with_topic = $this->course->topics();

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_user);
        $this->assertEquals('user_courses', $relation_with_user->getTable());
        $this->assertEquals('user_courses.course_id', $relation_with_user->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_courses.user_id', $relation_with_user->getQualifiedRelatedPivotKeyName());

        $this->assertInstanceOf(HasMany::class, $relation_with_lesson);
        $this->assertEquals('lessons.course_id', $relation_with_lesson->getQualifiedForeignKeyName());

        $this->assertInstanceOf(BelongsTo::class, $relation_with_topic);
        $this->assertEquals('id', $relation_with_topic->getOwnerKeyName());
        $this->assertEquals('topics_id', $relation_with_topic->getForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        course::unguard();
        $course = new course($this->initial);
        $this->assertSame($this->initial, $course->attributesToArray());
    }

    public function test_course_getter()
    {
        $this->course->setAttribute('name', 'Course Two');
        $this->assertEquals('Course Two', $this->course->getAttribute('name'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['name']));
        $this->assertEquals('string', gettype($this->initial['described']));
        $this->assertEquals('integer', gettype($this->initial['topic_id']));
    }
}
