@extends('layouts.public')

@section('title', 'Repair Pricing - Nullified Solutions')

@section('content')
<section class="pricing-page">
    <h1>Repair Price List</h1>

    <p>
        Prices shown are labor charges only unless otherwise stated.
        Replacement parts may incur additional costs.
    </p>

    @php
        $categoryLabels = [
            'computer' => '💻 Computer / Laptop',
            'phone' => '📱 Mobile Phone',
            'tablet' => '📲 Tablet',
            'accessory' => '🔌 Accessories',
            'software' => '💾 Software',
        ];

        $grouped = $servicesWithPricing->groupBy('category');
    @endphp

    @foreach($categoryLabels as $category => $label)
        @if($grouped->has($category))
            <h2>{{ $label }}</h2>

            <table>
                <tr>
                    <th>Service</th>
                    <th>Price</th>
                </tr>

                @foreach($grouped[$category] as $service)
                    @foreach($service->pricings as $pricing)
                        <tr>
                            <td>{{ $service->service_name }}</td>
                            <td>{{ $pricing->price_label }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @endif
    @endforeach

    @if($premiumPlans->isNotEmpty())
        <h2>💎 Premium Plans</h2>

        <div class="premium-plans">
            @foreach($premiumPlans as $plan)
                <div class="plan-card">
                    <h3>{{ $plan->plan_name }}</h3>
                    <p class="plan-price">₱{{ number_format($plan->monthly_price, 2) }}/month</p>
                    @if($plan->description)
                        <p>{{ $plan->description }}</p>
                    @endif
                    @if($plan->features)
                        @php
                            $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true);
                        @endphp
                        @if($features)
                            <ul>
                                @foreach($features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
