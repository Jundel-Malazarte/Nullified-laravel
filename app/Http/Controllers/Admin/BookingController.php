<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Booking::with(['user', 'service'])->latest();

        if ($status && in_array($status, ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(15);

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'service', 'attachments']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,in_progress,completed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
            'priority' => ['nullable', 'in:low,normal,high'],
        ]);

        $booking->update($request->only(['status', 'admin_notes', 'priority']));

        return back()->with('success', 'Booking status updated successfully.');
    }
}
