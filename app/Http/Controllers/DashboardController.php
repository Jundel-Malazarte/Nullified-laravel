<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RepairService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $recentBookings = $user->bookings()
            ->with('service')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
            'completed_bookings' => $user->bookings()->where('status', 'completed')->count(),
            'in_progress_bookings' => $user->bookings()->where('status', 'in_progress')->count(),
        ];

        $services = RepairService::orderBy('category')->get();

        return view('dashboard', compact('user', 'recentBookings', 'stats', 'services'));
    }
}
