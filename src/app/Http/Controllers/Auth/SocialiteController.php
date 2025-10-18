<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    /**
     * Redirect to Google OAuth page
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find or create user
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Update existing user's Google info
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ]);
            } else {
                // Create new user (inactive by default, requires admin activation)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)), // Random password
                    'email_verified_at' => now(), // Auto verify email for Google users
                    'is_active' => false, // Requires admin activation
                ]);
            }

            // Check if user is active before login
            if (!$user->isActive()) {
                return redirect()->route('login')
                    ->with('error', 'Your account has been created but needs to be activated by an administrator. Please contact support.');
            }

            // Login the user
            Auth::login($user, true);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Successfully logged in with Google!');

        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to login with Google. Please try again.');
        }
    }

    /**
     * Redirect to GitHub OAuth page (optional)
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Handle GitHub OAuth callback (optional)
     *
     * @return RedirectResponse
     */
    public function handleGithubCallback(): RedirectResponse
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::where('email', $githubUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'github_id' => $githubUser->getId(),
                    'avatar' => $githubUser->getAvatar(),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ]);
            } else {
                // Create new user (inactive by default, requires admin activation)
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'github_id' => $githubUser->getId(),
                    'avatar' => $githubUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                    'is_active' => false, // Requires admin activation
                ]);
            }

            // Check if user is active before login
            if (!$user->isActive()) {
                return redirect()->route('login')
                    ->with('error', 'Your account has been created but needs to be activated by an administrator. Please contact support.');
            }

            Auth::login($user, true);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Successfully logged in with GitHub!');

        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to login with GitHub. Please try again.');
        }
    }
}
