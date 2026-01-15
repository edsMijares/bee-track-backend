<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetTimeLogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_time_log(): void
    {
        try {
            $token = $this->login('antonetta.treutel', 'testpassword');
            $this->api($token, 'GET', '/api/time_log/read');
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'Error: ' . $th->getMessage());
        }
    }
}
