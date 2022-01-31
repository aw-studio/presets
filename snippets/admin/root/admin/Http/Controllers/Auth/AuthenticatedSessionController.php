<?php

namespace Admin\Http\Controllers\Auth;

use Admin\Ui\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @param  Page $page
     * @return Page
     */
    public function create(Page $page)
    {
        return $page
            ->page('Auth/Login')
            ->with('submit-route', route('admin.login'))
            ->with('forgot-password-route', route('admin.password.request'))
            ->with('lang', [
                'email'           => 'E-Mail',
                'password'        => 'Passwort',
                'remember'        => 'Eingeloggt bleiben',
                'login'           => 'Anmelden',
                'forgot_password' => 'Passwort vergessen?',
            ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request          $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
