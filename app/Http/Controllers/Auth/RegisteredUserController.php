<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\UserRegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly UserRegistrationService $registrationService,
    ) {}

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->registrationService->register(
            data: $request->validated(),
            autoLogin: config('auth.auto_login_after_registration', true),
        );

        if (config('auth.auto_login_after_registration', true)) {
            Auth::login($user);
        }

        return redirect()
            ->intended(route('dashboard.overview', absolute: false))
            ->with('success', 'Registration successful! Welcome aboard.');
    }
}
