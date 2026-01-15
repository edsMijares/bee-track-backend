<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TimeLogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_time_log(): void
    {
        try {
            $token = $this->login('antonetta.treutel', 'testpassword');
            $this->api($token, 'POST', '/api/time_log/create');
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'Error: ' . $th->getMessage());
        }
    }
}
