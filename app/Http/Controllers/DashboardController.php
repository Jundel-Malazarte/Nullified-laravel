<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RepairService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $allBookings = $user->bookings()
            ->with('service')
            ->latest()
            ->get();

        $recentBookings = $allBookings;

        $activeBookingsCount = $user->bookings()
            ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
            ->count();

        $completedBookingsCount = $user->bookings()
            ->where('status', 'completed')
            ->count();

        $nextBooking = $user->bookings()
            ->with('service')
            ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
            ->where('preferred_date', '>=', Carbon::today()->toDateString())
            ->orderBy('preferred_date', 'asc')
            ->first();

        // If no future booking, look for any active booking
        if (!$nextBooking) {
            $nextBooking = $user->bookings()
                ->with('service')
                ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
                ->orderBy('preferred_date', 'asc')
                ->first();
        }

        $nextDate = $nextBooking && $nextBooking->preferred_date
            ? Carbon::parse($nextBooking->preferred_date)->format('M j, Y')
            : 'TBD';

        $nextService = $nextBooking && $nextBooking->service
            ? $nextBooking->service->service_name
            : ($nextBooking ? $nextBooking->device_name : 'No booking');

        $stats = [
            'total_bookings' => $allBookings->count(),
            'active_bookings' => $activeBookingsCount,
            'completed_bookings' => $completedBookingsCount,
            'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
            'in_progress_bookings' => $user->bookings()->where('status', 'in_progress')->count(),
            'next_date' => $nextDate,
            'next_service' => $nextService,
        ];

        $services = RepairService::orderBy('category')->get();

        return view('dashboard', compact('user', 'recentBookings', 'stats', 'services'));
    }
}
