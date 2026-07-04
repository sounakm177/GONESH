<?php

namespace App\Services\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegistrationService
{
    public function register(array $data, bool $autoLogin = true): User
    {
        return DB::transaction(function () use ($data, $autoLogin) {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'] ?? $this->generateUniqueUsername($data['name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);

            $this->createDefaultProfile($user);

            event(new UserRegistered($user));

            return $user;
        });
    }

    public function createDefaultProfile(User $user): UserProfile
    {
        return $user->profile()->create([
            'locale' => app()->getLocale(),
            'timezone' => config('app.timezone'),
        ]);
    }

    public function generateUniqueUsername(string $name): string
    {
        $base = Str::slug(explode(' ', $name)[0]);
        $username = $base;
        $i = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . $i;
            $i++;
        }

        return $username;
    }
}
