<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_logout(): void
    {
        try {
            $token = $this->login('antonetta.treutel', 'testpassword');
            $this->api($token, 'POST', '/api/auth/logout');
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'Account creation failed: ' . $th->getMessage());
        }
    }
}
