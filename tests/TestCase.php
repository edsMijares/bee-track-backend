<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function login($username, $password)
    {
        $response = $this->postJson('/api/auth/login', [
            'username' => $username,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        return $response->json('token');
    }

    public function api($token, $method, $uri, array $data = [])
    {
        try {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->json($method, $uri, $data);
    
            $json = json_encode($response->json(), JSON_PRETTY_PRINT);
            fwrite(STDOUT, "\nResponse:\n$json\n");
        } catch (\Throwable $th) {
            $this->assertTrue(false, 'API request failed: ' . $th->getMessage());
        }               
    }
}
