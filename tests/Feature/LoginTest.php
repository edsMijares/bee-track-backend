<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        try {
            $response = $this->postJson('/api/auth/login', [
                'username' => 'antonetta.treutel',
                // 'email' => Faker::create()->unique()->safeEmail(),
                'password' => 'testpassword',
            ]);
            dump($response->json());
            $response->assertStatus(200);
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'Account creation failed: ' . $th->getMessage());
        }
    }
}
