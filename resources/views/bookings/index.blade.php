@extends('layouts.public')

@section('title', 'My Bookings - Nullified Solutions')

@section('content')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px; min-height: 60vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>My Repair Bookings</h2>
        <a href="{{ route('bookings.create') }}" class="header-cta" style="padding: 10px 18px;">+ Book a New Repair</a>
    </div>

    @if(session('success'))
        <div class="form-message success" style="margin-bottom: 20px; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; padding: 12px 16px; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: rgba(16, 28, 45, 0.96); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 24px; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #a9b7d1; font-size: 13px;">
                    <th style="padding: 12px 10px;">Booking ID</th>
                    <th style="padding: 12px 10px;">Device</th>
                    <th style="padding: 12px 10px;">Service</th>
                    <th style="padding: 12px 10px;">Preferred Date</th>
                    <th style="padding: 12px 10px;">Status</th>
                    <th style="padding: 12px 10px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                        <td style="padding: 12px 10px;">#{{ $booking->id }}</td>
                        <td style="padding: 12px 10px;">{{ $booking->device_name }} ({{ $booking->device_brand }})</td>
                        <td style="padding: 12px 10px;">{{ $booking->service->service_name ?? 'N/A' }}</td>
                        <td style="padding: 12px 10px;">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M j, Y') }}</td>
                        <td style="padding: 12px 10px;">
                            <span style="text-transform: capitalize; padding: 4px 8px; border-radius: 6px; font-size: 12px; background: rgba(79, 124, 255, 0.15); color: #dfe9ff;">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td style="padding: 12px 10px;">
                            <a href="{{ route('bookings.show', $booking->id) }}" style="color: #4f7cff; font-size: 13px;">View Details →</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #a9b7d1; padding: 32px;">No bookings found. <a href="{{ route('bookings.create') }}" style="color: #4f7cff;">Book a repair now</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
