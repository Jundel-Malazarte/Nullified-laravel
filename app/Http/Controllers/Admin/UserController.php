<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $search = $request->query('search');

        $query = User::with(['profile', 'premiumAccount'])->latest();

        if ($role && in_array($role, ['customer', 'admin', 'technician'])) {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users', 'role', 'search'));
    }

    public function show(User $user)
    {
        $user->load(['profile', 'bookings.service', 'premiumAccount.plan']);

        return view('admin.users.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => ['required', 'in:active,inactive,suspended'],
            'role' => ['required', 'in:customer,admin,technician'],
            'is_premium' => ['required', 'boolean'],
        ]);

        $user->update($request->only(['status', 'role', 'is_premium']));

        return back()->with('success', 'User updated successfully.');
    }
}
