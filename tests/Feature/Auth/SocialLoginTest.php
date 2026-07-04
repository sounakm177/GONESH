<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class SocialLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function mockSocialiteUser(array $overrides = []): SocialiteUser
    {
        $socialUser = Mockery::mock(SocialiteUser::class);
        $socialUser->shouldReceive('getId')->andReturn($overrides['id'] ?? '123456789');
        $socialUser->shouldReceive('getEmail')->andReturn($overrides['email'] ?? 'social@example.com');
        $socialUser->shouldReceive('getName')->andReturn($overrides['name'] ?? 'Social User');
        $socialUser->shouldReceive('getAvatar')->andReturn($overrides['avatar'] ?? 'https://example.com/avatar.jpg');

        return $socialUser;
    }

    public function test_redirects_to_google_provider(): void
    {
        $response = $this->get(route('auth.redirect', ['provider' => 'google']));

        $response->assertRedirect();
    }

    public function test_redirects_to_github_provider(): void
    {
        $response = $this->get(route('auth.redirect', ['provider' => 'github']));

        $response->assertRedirect();
    }

    public function test_creates_new_user_on_social_callback(): void
    {
        $socialUser = $this->mockSocialiteUser([
            'id' => 'google_123',
            'email' => 'newuser@example.com',
            'name' => 'New Social User',
            'avatar' => 'https://example.com/avatar.jpg',
        ]);

        Socialite::shouldReceive('driver->user')->andReturn($socialUser);

        $response = $this->get(route('auth.callback', ['provider' => 'google']));

        $response->assertRedirect(route('dashboard.overview', absolute: false));
        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'google_id' => 'google_123',
            'provider' => 'google',
            'avatar' => 'https://example.com/avatar.jpg',
        ]);
    }

    public function test_links_existing_user_on_social_callback(): void
    {
        $user = User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $socialUser = $this->mockSocialiteUser([
            'id' => 'github_456',
            'email' => 'existing@example.com',
            'name' => 'Existing User',
        ]);

        Socialite::shouldReceive('driver->user')->andReturn($socialUser);

        $response = $this->get(route('auth.callback', ['provider' => 'github']));

        $response->assertRedirect(route('dashboard.overview', absolute: false));
        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'email' => 'existing@example.com',
            'github_id' => 'github_456',
            'provider' => 'github',
        ]);
    }

    public function test_merges_into_existing_social_account(): void
    {
        $user = User::factory()->social('google')->create([
            'email' => 'already-social@example.com',
        ]);

        $socialUser = $this->mockSocialiteUser([
            'id' => 'google_789',
            'email' => 'already-social@example.com',
            'name' => 'Already Social',
        ]);

        Socialite::shouldReceive('driver->user')->andReturn($socialUser);

        $response = $this->get(route('auth.callback', ['provider' => 'google']));

        $response->assertRedirect(route('dashboard.overview', absolute: false));
        $this->assertAuthenticated();

        $user->refresh();
        $this->assertEquals('google_789', $user->google_id);
    }

    public function test_handles_invalid_provider(): void
    {
        $response = $this->get('/auth/twitter/redirect');

        $response->assertRedirect(route('login'));
    }

    public function test_handles_socialite_exception(): void
    {
        Socialite::shouldReceive('driver->user')->andThrow(
            new \Laravel\Socialite\Two\InvalidStateException()
        );

        $response = $this->get(route('auth.callback', ['provider' => 'github']));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
    }

    public function test_social_login_updates_last_login_at(): void
    {
        $socialUser = $this->mockSocialiteUser([
            'id' => 'google_lastlogin',
            'email' => 'lastlogin@example.com',
        ]);

        Socialite::shouldReceive('driver->user')->andReturn($socialUser);

        $this->freezeTime();

        $this->get(route('auth.callback', ['provider' => 'google']));

        $user = User::where('email', 'lastlogin@example.com')->first();
        $this->assertNotNull($user->last_login_at);
        $this->assertEquals(now()->startOfSecond(), $user->last_login_at);
    }

    public function test_user_can_link_additional_provider(): void
    {
        $user = User::factory()->social('google')->create([
            'email' => 'dual-social@example.com',
        ]);

        $this->actingAs($user);

        $socialUser = $this->mockSocialiteUser([
            'id' => 'github_dual',
            'email' => 'dual-social@example.com',
            'name' => $user->name,
        ]);

        Socialite::shouldReceive('driver->user')->andReturn($socialUser);

        $this->get(route('auth.callback', ['provider' => 'github']));

        $user->refresh();
        $this->assertEquals('github_dual', $user->github_id);
        $this->assertEquals('github', $user->provider);
    }
}
