<?php

namespace Tests\Unit\Views;

use App\Models\User;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function test_index_view_lesson()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/lessons/1');
        $response->assertStatus(200);
        $response->assertViewIs('layouts.functions.lessons');
        $response->assertViewHas('data');
        $response->assertSee('Lesson');
    }
}
