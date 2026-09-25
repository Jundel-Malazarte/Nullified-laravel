<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminPasswordResetController extends Controller
{
    /**
     * Show the admin password reset form.
     */
    public function showResetForm()
    {
        return view('admin.auth.reset-password');
    }

    /**
     * Handle an admin password reset request.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);

        $email = strtolower(trim($request->email));

        // Find user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with that email address.',
            ])->withInput($request->only('email'));
        }

        // Check if user has admin role
        if ($user->role !== 'admin') {
            return back()->withErrors([
                'email' => 'This account does not have admin access.',
            ])->withInput($request->only('email'));
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.login')->with('status', 'Admin password updated successfully. You can now log in with your new password.');
    }
}
