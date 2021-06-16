<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->user = new User();
        $this->initial = [
            'email' => 'userfels@gmai.com',
            'name' => 'Minh Pham',
            'avatar' => 'images/avatar_default.png',
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['name', 'email', 'avatar'], $this->user->getFillable());
    }

    public function test_user_relations()
    {
        $relation_with_topic = $this->user->topics();
        $relation_with_course = $this->user->courses();
        $relation_with_lesson = $this->user->lessons();

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_topic);
        $this->assertEquals('user_topics', $relation_with_topic->getTable());
        $this->assertEquals('user_topics.user_id', $relation_with_topic->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_topics.topic_id', $relation_with_topic->getQualifiedRelatedPivotKeyName());

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_course);
        $this->assertEquals('user_courses', $relation_with_course->getTable());
        $this->assertEquals('user_courses.user_id', $relation_with_course->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_courses.course_id', $relation_with_course->getQualifiedRelatedPivotKeyName());

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_lesson);
        $this->assertEquals('user_lessons', $relation_with_lesson->getTable());
        $this->assertEquals('user_lessons.user_id', $relation_with_lesson->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_lessons.lesson_id', $relation_with_lesson->getQualifiedRelatedPivotKeyName());

    }

    public function test_properties_have_valid_values()
    {
        User::unguard();
        $user = new User($this->initial);
        $this->assertSame($this->initial, $user->attributesToArray());
    }

    public function test_user_getter()
    {
        $this->user->setAttribute('name', 'Minh Pham');
        $this->assertEquals('Minh Pham', $this->user->getAttribute('name'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['email']));
        $this->assertEquals('string', gettype($this->initial['name']));
        $this->assertEquals('string', gettype($this->initial['avatar']));
        $this->assertTrue(Str::contains($this->initial['email'], '@'));
        $this->assertTrue(Str::contains($this->initial['avatar'], ['.png', '.jpg', '.jpge', '.web']));
        
    }
}
