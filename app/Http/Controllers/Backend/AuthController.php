<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginView(): View
    {
        return view('backend.login.index');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->safe()->only(['email', 'password']);
            $rememberMe  = $request->boolean('remember');

            if (auth()->attempt($credentials, $rememberMe)) {
                return to_route('backend.dashboard')->withSuccess(__('messages.success.login'));
            }

            return back()->withWarning(__('messages.warning.login'));
        } catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.login'));
        }
    }

    public function logout(): RedirectResponse
    {
        try {
            auth()->logout();
            return to_route('backend.login.view')->withSuccess(__('messages.success.logout'));
        } catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.logout'));
        }
    }
}
