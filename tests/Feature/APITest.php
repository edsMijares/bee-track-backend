<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_api_returns_success_message()
    {
        $response = $this->getJson('/api/test');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'API is working'
                 ]);
    }
}
