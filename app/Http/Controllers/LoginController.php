<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class LoginController extends Controller
{
    public function loginView()
    {
        $auth_status = auth()->check();
        if ($auth_status == 1) {
            return redirect('/dashboard');
        } else {
            return view('login_form');
        }
    }
    public function registerView()
    {
        $auth_status = auth()->check();
        if ($auth_status == 1) {
            return redirect('/dashboard');
        } else {
            return view('login_form');
        }
    }
    // public function register(Request $request): RedirectResponse
    public function register(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            // 'password' => ['required', Rules\Password::defaults()],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     // 'name' => $request->name,
        //     'name' => "A",
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        $new_user = new User;
        $new_user->name = "A";
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->save();
        Auth::login($new_user);
        // Log::debug('We have a new member' . $request->email . ' on our platform.');
        // Log::emergency('We have a new member' . $request->email . ' on our platform.');
        // Log::channel('busines_slack')->info('We have a new member {user} on our platform.', ['user' => $request->email]);
        return redirect('/dashboard');


        // event(new Registered($user));

    }
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            echo 'not working';
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
