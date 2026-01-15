<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;

class CreateAccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_account()
    {
        try {
            $response = $this->postJson('/api/account/create', [
                'username' => Faker::create()->userName(),
                'email' => Faker::create()->unique()->safeEmail(),
                'password' => 'testpassword',
                'password_confirmation' => 'testpassword'
            ]);
            dump($response->json());
            $response->assertStatus(200);
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'Account creation failed: ' . $th->getMessage());
        }
    }
}
