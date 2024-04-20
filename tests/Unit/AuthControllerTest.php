<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_valide()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(202)
            ->assertJson([
                'user' => [
                    'email' => 'test@example.com',
                ]
            ]);
    }

    public function test_login_invalide()
    {
        $response = $this->postJson('/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Email or Password are incorrect',
            ]);
    }
}
