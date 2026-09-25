@extends('layouts.public')

@section('title', 'Nullified Solutions - Tech Repair Services')

@section('content')
<section class="hero">
    <div class="overlay">
        <p class="eyebrow">NULLIFIED SOLUTIONS TECH REPAIR</p>
        <h1 class="typing-wrap">
            <span class="typing-text" data-text="Computer & Phone Repair | Laptop & Tablet Repair | Fast Tech Repair |"></span>
        </h1>

        <p class="hero-copy">Fast, affordable, and reliable repair services for the devices your work and life depend on.</p>

        <div class="hero-actions">
            @auth
                <button onclick="window.location.href='{{ route('bookings.create') }}'" type="button">Book a repair <span aria-hidden="true">↗</span></button>
            @else
                <button onclick="window.location.href='{{ route('login') }}'" type="button">Book a repair <span aria-hidden="true">↗</span></button>
            @endauth
            <a class="text-link" href="#services">Explore services <span aria-hidden="true">↓</span></a>
        </div>
    </div>
    <div class="hero-note"><span class="status-dot"></span> Same-day service available</div>
</section>

<section class="services" id="services">
    <div class="section-heading">
        <p class="eyebrow">WHAT WE FIX</p>
        <h2>Our Services</h2>
        <p>Practical, careful repairs from quick fixes to tricky hardware problems.</p>
    </div>

    <div class="cards">
        <a href="{{ route('services.index') }}" class="service-link">
            <div class="card">
                <h3>💻 Laptop Repair</h3>
                <p>Hardware upgrades, SSD installation, screen replacement and motherboard repair.</p>
            </div>
        </a>

        <a href="{{ route('services.index') }}" class="service-link">
            <div class="card">
                <h3>📱 Phone Repair</h3>
                <p>Screen replacement, battery replacement, camera repair and charging port repair.</p>
            </div>
        </a>

        <a href="{{ route('services.index') }}" class="service-link">
            <div class="card">
                <h3>🛠 Diagnostics</h3>
                <p>Complete hardware and software diagnostics for all major brands.</p>
            </div>
        </a>
    </div>
</section>

<section class="pricing">
    <h2>Repair Pricing</h2>
    <p class="pricing-subtitle">Transparent pricing with no hidden fees.</p>

    <div class="pricing-grid">
        @php
            $groupedServices = $featuredServices->groupBy('category');
            $categoryLabels = [
                'computer' => '💻 Computer / Laptop',
                'phone' => '📱 Mobile Phone',
                'tablet' => '📲 Tablet',
                'software' => '💾 Software',
                'accessory' => '🔌 Accessories'
            ];
        @endphp

        @foreach($categoryLabels as $category => $label)
            @if($groupedServices->has($category))
                <div class="price-card">
                    <h3>{{ $label }}</h3>
                    <ul>
                        @foreach($groupedServices[$category] as $service)
                            @if($service->pricings->isNotEmpty())
                                @foreach($service->pricings as $pricing)
                                    <li>
                                        <span>{{ $service->service_name }}</span>
                                        <strong>{{ $pricing->price_label }}</strong>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
</section>

<section class="faq" id="faq">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-container">
        <div class="faq-item">
            <button class="faq-question">
                How long does a repair take?
                <span>+</span>
            </button>
            <div class="faq-answer">
                <p>Most repairs are completed within 1–2 hours. Complex motherboard repairs may require 2–5 business days.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Do you provide a warranty?
                <span>+</span>
            </button>
            <div class="faq-answer">
                <p>Yes. Most repairs include a 30–90 day service warranty depending on the repair performed.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Do I need an appointment?
                <span>+</span>
            </button>
            <div class="faq-answer">
                <p>Walk-ins are welcome, but appointments help us serve you faster.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Can my files be recovered?
                <span>+</span>
            </button>
            <div class="faq-answer">
                <p>In many cases yes. We offer data recovery services depending on the condition of the storage device.</p>
            </div>
        </div>
    </div>
</section>

<section class="contact" id="contact">
    <h2>Send Us a Message</h2>
    <p>Have questions? Send us a message and we'll get back to you as soon as possible.</p>

    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
        @csrf
        <input type="text" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}" required />
        @error('full_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required />
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" />
        @error('phone')
            <span class="error">{{ $message }}</span>
        @enderror

        <textarea name="message" rows="6" placeholder="Describe your device problem..." required>{{ old('message') }}</textarea>
        @error('message')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">Send Message</button>
    </form>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
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
