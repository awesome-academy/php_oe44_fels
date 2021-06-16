<?php

namespace Tests\Unit\Models;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class TopicTest extends TestCase
{
    
    public function setUp() : void
    {
        parent::setUp();
        $this->topic = new Topic();
        $this->initial = [
            'name' => 'Information Technology',
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['name'], $this->topic->getFillable());
    }

    public function test_topic_relations()
    {
        $relation_with_user = $this->topic->users();
        $relation_with_course = $this->topic->courses();

        $this->assertInstanceOf(BelongsToMany::class, $relation_with_user);
        $this->assertEquals('user_topics', $relation_with_user->getTable());
        $this->assertEquals('user_topics.topic_id', $relation_with_user->getQualifiedForeignPivotKeyName());
        $this->assertEquals('user_topics.user_id', $relation_with_user->getQualifiedRelatedPivotKeyName());

        $this->assertInstanceOf(HasMany::class, $relation_with_course);
        $this->assertEquals('courses.topic_id', $relation_with_course->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        topic::unguard();
        $topic = new topic($this->initial);
        $this->assertSame($this->initial, $topic->attributesToArray());
    }

    public function test_topic_getter()
    {
        $this->topic->setAttribute('name', 'Family');
        $this->assertEquals('Family', $this->topic->getAttribute('name'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['name']));
    }
}
