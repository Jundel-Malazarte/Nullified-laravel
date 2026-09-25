<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\RepairService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('service')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = RepairService::orderBy('category')->orderBy('service_name')->get();

        return view('bookings.create', compact('services'));
    }

    public function store(BookingRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';
        $validated['priority'] = auth()->user()->is_premium ? 'high' : 'normal';

        $booking = Booking::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Your booking request #'.$booking->id.' has been submitted successfully!');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access to booking details.');
        }

        $booking->load(['service', 'attachments', 'user']);

        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking has been cancelled.');
    }
}
