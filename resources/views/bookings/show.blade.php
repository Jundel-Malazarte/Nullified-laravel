@extends('layouts.public')

@section('title', 'Booking Details - Nullified Solutions')

@section('content')
<div style="max-width: 800px; margin: 40px auto; padding: 0 20px; min-height: 60vh;">
    <a href="{{ route('bookings.index') }}" style="display: inline-block; margin-bottom: 20px; color: #4f7cff;">← Back to My Bookings</a>

    @if(session('success'))
        <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: rgba(255, 90, 90, 0.15); border: 1px solid rgba(255, 90, 90, 0.3); color: #ffd9d9; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background: rgba(16, 28, 45, 0.96); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); padding-bottom: 16px;">
            <h2 style="margin: 0;">Booking #{{ $booking->id }}</h2>
            <span style="text-transform: capitalize; padding: 6px 14px; border-radius: 8px; font-weight: 600; background: rgba(79, 124, 255, 0.15); color: #dfe9ff;">
                Status: {{ $booking->status }}
            </span>
        </div>

        <div style="display: grid; gap: 16px;">
            <div>
                <strong style="color: #a9b7d1; font-size: 13px; display: block;">Device:</strong>
                <p style="margin: 4px 0 0; font-size: 16px;">{{ $booking->device_name }} ({{ $booking->device_brand }} {{ $booking->device_model }})</p>
            </div>

            <div>
                <strong style="color: #a9b7d1; font-size: 13px; display: block;">Service Requested:</strong>
                <p style="margin: 4px 0 0; font-size: 16px;">{{ $booking->service->service_name ?? 'N/A' }}</p>
            </div>

            <div>
                <strong style="color: #a9b7d1; font-size: 13px; display: block;">Appointment Date & Time:</strong>
                <p style="margin: 4px 0 0; font-size: 16px;">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('F j, Y') }} {{ $booking->preferred_time ? 'at '.$booking->preferred_time : '' }}</p>
            </div>

            <div>
                <strong style="color: #a9b7d1; font-size: 13px; display: block;">Issue Description:</strong>
                <p style="margin: 4px 0 0; font-size: 15px; line-height: 1.6;">{{ $booking->issue_description }}</p>
            </div>

            @if($booking->admin_notes)
                <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06); padding: 16px; border-radius: 10px; margin-top: 10px;">
                    <strong style="color: #4f7cff; font-size: 13px; display: block;">Technician Notes:</strong>
                    <p style="margin: 6px 0 0; font-size: 14px;">{{ $booking->admin_notes }}</p>
                </div>
            @endif
        </div>

        @if($booking->status === 'pending')
            <div style="margin-top: 32px; border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 20px;">
                <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                    @csrf
                    <button type="submit" style="background: rgba(255, 90, 90, 0.15); color: #ffd9d9; border: 1px solid rgba(255, 90, 90, 0.3); padding: 10px 18px; border-radius: 8px; cursor: pointer;">
                        Cancel Booking
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
