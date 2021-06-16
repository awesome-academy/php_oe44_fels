<?php

namespace Tests\Unit\Views;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ViewWordTest extends TestCase
{
    public function test_index_view_word()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/words');
        $response->assertOk();
        $response->assertViewIs('layouts.functions.seeWord');
        $response->assertSee('Word');
    }
}
