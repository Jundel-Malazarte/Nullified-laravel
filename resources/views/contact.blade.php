@extends('layouts.public')

@section('title', 'Contact Us - Nullified Solutions')

@section('content')
<section class="contact" id="contact">
    <h2>Send Us a Message</h2>
    <p>Have questions? Send us a message and we'll get back to you as soon as possible.</p>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
        @csrf

        <input
            type="text"
            name="full_name"
            placeholder="Full Name"
            value="{{ old('full_name') }}"
            required
        />
        @error('full_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <input
            type="email"
            name="email"
            placeholder="Email Address"
            value="{{ old('email') }}"
            required
        />
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <input
            type="text"
            name="phone"
            placeholder="Phone Number"
            value="{{ old('phone') }}"
        />
        @error('phone')
            <span class="error">{{ $message }}</span>
        @enderror

        <textarea
            name="message"
            rows="6"
            placeholder="Describe your device problem..."
            required
        >{{ old('message') }}</textarea>
        @error('message')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">Send Message</button>
    </form>
</section>

<section class="about">
    <h2>Why Choose Us?</h2>
    <div class="features">
        <div>✔ Certified Technicians</div>
        <div>✔ Genuine Parts</div>
        <div>✔ Same Day Service</div>
        <div>✔ 90-Day Warranty</div>
    </div>
</section>
@endsection
