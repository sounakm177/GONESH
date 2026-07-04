<?php

namespace App\Services\Auth;

use App\Events\SocialAccountLinked;
use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialLoginService
{
    public function __construct(
        private readonly UserRegistrationService $registrationService,
    ) {}

    public function handleLogin(string $provider, SocialiteUser $socialUser): User
    {
        $field = $provider === 'google' ? 'google_id' : 'github_id';

        $existingUser = User::where($field, $socialUser->getId())->first();

        if ($existingUser) {
            return $existingUser;
        }

        $emailUser = User::where('email', $socialUser->getEmail())->first();

        if ($emailUser) {
            $emailUser->update([
                $field => $socialUser->getId(),
                'provider' => $provider,
                'avatar' => $socialUser->getAvatar(),
            ]);

            event(new SocialAccountLinked($emailUser, $provider));

            return $emailUser;
        }

        return DB::transaction(function () use ($provider, $socialUser, $field) {
            $name = $socialUser->getName() ?? $socialUser->getNickname() ?? 'User';
            $email = $socialUser->getEmail();

            $user = User::create([
                'name' => $name,
                'username' => $this->registrationService->generateUniqueUsername($name),
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                $field => $socialUser->getId(),
                'provider' => $provider,
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
                'status' => 'active',
            ]);

            $this->registrationService->createDefaultProfile($user);

            event(new UserRegistered($user, true));

            return $user;
        });
    }
}
