@extends('layouts.public')

@section('title', 'Our Services - Nullified Solutions')

@section('content')
<section class="services">
    <h1>Our Repair Services</h1>

    @php
        $categoryLabels = [
            'computer' => '💻 Computer Repair',
            'phone' => '📱 Phone Repair',
            'tablet' => '📲 Tablet Repair',
            'accessory' => '🔌 Accessories',
            'software' => '💾 Software',
        ];
    @endphp

    <div class="cards">
        @forelse($services as $category => $categoryServices)
            @foreach($categoryServices as $service)
                <div class="card">
                    <h3>{{ $categoryLabels[$category] ?? ucfirst($category) }}</h3>
                    <p><strong>{{ $service->service_name }}</strong></p>
                    @if($service->short_description)
                        <p>{{ $service->short_description }}</p>
                    @endif
                    @if($service->pricings->isNotEmpty())
                        <p class="price-tag">
                            @foreach($service->pricings as $pricing)
                                {{ $pricing->price_label }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                </div>
            @endforeach
        @empty
            <div class="card">
                <h3>💻 Computer Repair</h3>
                <p>Hardware replacement, motherboard repair, RAM and SSD upgrades, software installation, virus removal, data recovery, and diagnostics.</p>
            </div>

            <div class="card">
                <h3>📱 Phone Repair</h3>
                <p>Screen replacement, battery replacement, charging port repair, camera repair, speaker repair, and software flashing.</p>
            </div>

            <div class="card">
                <h3>📲 Tablet Repair</h3>
                <p>Screen replacement, battery replacement, charging issues, software repair, and water damage cleaning.</p>
            </div>

            <div class="card">
                <h3>⌚ Smartwatch Repair</h3>
                <p>Battery replacement, screen repair, charging issues, and software updates.</p>
            </div>

            <div class="card">
                <h3>🎮 Game Console Repair</h3>
                <p>HDMI replacement, overheating repair, fan cleaning, storage upgrades, and controller repair.</p>
            </div>

            <div class="card">
                <h3>🖥 Custom PC Build</h3>
                <p>Gaming PC assembly, workstation builds, cable management, cooling upgrades, and performance tuning.</p>
            </div>

            <div class="card">
                <h3>🛠 Diagnostics</h3>
                <p>Comprehensive hardware and software diagnostics for all major brands and devices.</p>
            </div>

            <div class="card">
                <h3>💾 Data Recovery</h3>
                <p>Recover lost or deleted files from hard drives, SSDs, USB drives, and memory cards.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection