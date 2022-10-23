<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_login_if_registered()
    {
        $user = User::factory()->create();

        $response =
            $this
//                ->withoutExceptionHandling() // permet d'avoir des détails sur l'erreur
                ->post('/api/login', [
                    'email' => $user->email,
                    'password' => 'password'
                ]);

        //$response->json() permet de faire un json_decode de la réponse

        $this->assertEquals('success', $response->json('status'));
        $this->assertEquals($user->toArray(), $response->json('user'));
        $this->assertNotNull($response->json('token'));
    }

    public function test_can_not_login_if_not_registered()
    {
        $this
            ->post('/api/login', [
                'email' => 'test@test.com',
                'password' => 'password'
            ])
            ->assertExactJson([
                'status' => 'error',
                'message' => 'Adresse email ou mot de passe incorrecte'
            ]);
    }

    public function test_can_logout_if_logged_in()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user, 'sanctum') // simule la connexion
            ->post('/api/logout')
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Déconnexion réussie'
            ]);
    }
}
