<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Fortify;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

   

public function store(LoginRequest $request): LoginResponse
{
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && !$user->activo) {
        throw ValidationException::withMessages([
            Fortify::username() => 'Tu cuenta está desactivada.',
        ]);
    }

    app(AttemptToAuthenticate::class)->handle($request, 'web');

    return app(LoginResponse::class);
}




    public function destroy(Request $request): LogoutResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }
}