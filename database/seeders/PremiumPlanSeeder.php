<?php

namespace Database\Seeders;

use App\Models\PremiumPlan;
use Illuminate\Database\Seeder;

class PremiumPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'plan_name' => 'Basic',
                'description' => 'Essential support coverage for minor repairs and diagnostics.',
                'monthly_price' => 299.00,
                'features' => [
                    'priority' => 'Standard',
                    'discount' => '10%',
                    'support' => 'Email support'
                ],
                'is_active' => true,
            ],
            [
                'plan_name' => 'Pro',
                'description' => 'Priority scheduling and repair discounts for frequent customers.',
                'monthly_price' => 699.00,
                'features' => [
                    'priority' => 'Priority',
                    'discount' => '20%',
                    'support' => 'Phone + email support'
                ],
                'is_active' => true,
            ],
            [
                'plan_name' => 'Elite',
                'description' => 'Full premium support with advanced device care and priority service.',
                'monthly_price' => 1299.00,
                'features' => [
                    'priority' => 'VIP',
                    'discount' => '30%',
                    'support' => 'Dedicated support line'
                ],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            PremiumPlan::create($plan);
        }
    }
}
