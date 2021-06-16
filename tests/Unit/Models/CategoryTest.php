<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->category = new Category();
        $this->initial = [
            'name' => 'Nouns',
            'described' => 'Nothing...',
        ];
    }

    public function test_contains_valid_fillable()
    {
        $this->assertEquals(['name', 'described'], $this->category->getFillable());
    }

    public function test_category_relations()
    {
        $relation_with_word = $this->category->words();
        $this->assertInstanceOf(HasMany::class, $relation_with_word);
        $this->assertEquals('words.category_id', $relation_with_word->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        category::unguard();
        $category = new category($this->initial);
        $this->assertSame($this->initial, $category->attributesToArray());
    }

    public function test_category_getter()
    {
        $this->category->setAttribute('name', 'Verb');
        $this->assertEquals('Verb', $this->category->getAttribute('name'));
    }

    public function test_data_types()
    {
        $this->assertEquals('string', gettype($this->initial['name']));
        $this->assertEquals('string', gettype($this->initial['described']));
    }
}
