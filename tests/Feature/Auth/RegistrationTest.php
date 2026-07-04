<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_get(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_get(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_verify_email_get(): void
    {
        // Use an unverified user
        $user = \App\Models\User::factory()->unverified()->create();
        $response = $this->actingAs($user)->get('/verify-email');
        $response->assertStatus(200);
    }

    public function test_registration_with_empty_fields_fails_validation(): void
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_registration_without_terms_fails(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertSessionHasErrors('terms');
    }

    public function test_registration_with_weak_password_fails(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_registration_succeeds_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
            'terms' => '1',
        ]);

        $response->assertRedirect(route('dashboard.overview', absolute: false));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }
}
