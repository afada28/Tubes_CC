<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Debug: Test if callback is reached
        \Log::info('=== CALLBACK REACHED ===');

        try {
            Log::info('Google OAuth callback started');

            // Disable SSL verification for Avast Firewall
            $googleUser = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client([
                    'verify' => false,
                    'curl' => [
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_SSL_VERIFYHOST => 0,
                    ]
                ]))
                ->user();

            Log::info('Google user retrieved', ['email' => $googleUser->getEmail()]);

            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Link existing account with Google
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                    Log::info('Linked existing user with Google', ['user_id' => $user->id]);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => bcrypt(uniqid()),
                    ]);
                    Log::info('Created new user', ['user_id' => $user->id]);
                }
            }

            Auth::login($user, true); // true = remember me
            Log::info('Auth::login called', ['user_id' => $user->id, 'is_authenticated' => Auth::check()]);

            // Redirect based on user role
            if ($user->is_admin) {
                Log::info('Redirecting admin to dashboard');
                return redirect('/dashboard');
            }

            Log::info('Redirecting user to homepage');
            return redirect('/');


        } catch (Exception $e) {
            Log::error('Google OAuth callback error', ['error' => $e->getMessage()]);
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
