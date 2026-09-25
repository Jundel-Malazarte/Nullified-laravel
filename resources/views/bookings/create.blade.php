@extends('layouts.public')

@section('title', 'Book a Repair - Nullified Solutions')

@section('content')
<section class="contact" style="max-width: 760px; margin: 40px auto; padding: 0 20px;">
    <h2>Book a Repair</h2>
    <p>Fill out the details below and we'll confirm your repair slot.</p>

    @if ($errors->any())
        <div style="background: rgba(255, 90, 90, 0.15); border: 1px solid rgba(255, 90, 90, 0.3); color: #ffd9d9; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST" id="bookingCreateForm">
        @csrf

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Device Type</label>
        <select name="device_name" required style="width: 100%; margin-bottom: 16px; background: rgba(255, 255, 255, 0.05); color: #fff; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 12px;">
            <option value="">Select Device Type</option>
            <option value="Laptop" {{ old('device_name') === 'Laptop' ? 'selected' : '' }}>Laptop / Computer</option>
            <option value="Phone" {{ old('device_name') === 'Phone' ? 'selected' : '' }}>Mobile Phone</option>
            <option value="Tablet" {{ old('device_name') === 'Tablet' ? 'selected' : '' }}>Tablet</option>
        </select>

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Device Brand</label>
        <input type="text" name="device_brand" placeholder="e.g. Dell, Apple, Samsung" value="{{ old('device_brand') }}" required />

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Device Model</label>
        <input type="text" name="device_model" placeholder="e.g. XPS 13, iPhone 14, Galaxy Tab" value="{{ old('device_model') }}" required />

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Service / Issue</label>
        <select name="service_id" required style="width: 100%; margin-bottom: 16px; background: rgba(255, 255, 255, 0.05); color: #fff; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 12px;">
            <option value="">Select Service Needed</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->category }}: {{ $service->service_name }} ({{ $service->price_range }})
                </option>
            @endforeach
        </select>

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Preferred Appointment Date</label>
        <input type="date" name="preferred_date" min="{{ date('Y-m-d') }}" value="{{ old('preferred_date') }}" required />

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Preferred Time (Optional)</label>
        <input type="time" name="preferred_time" value="{{ old('preferred_time') }}" />

        <label style="display: block; margin-bottom: 6px; font-size: 13px; color: #a9b7d1;">Describe the Problem</label>
        <textarea name="issue_description" rows="5" placeholder="Tell us what issues you're experiencing with your device..." required>{{ old('issue_description') }}</textarea>

        <button type="submit" style="margin-top: 16px;">Submit Booking Request <span aria-hidden="true">↗</span></button>
    </form>
</section>
@endsection
