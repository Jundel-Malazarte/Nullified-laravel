<?php

namespace App\Http\Controllers;

use App\Models\PremiumPlan;
use App\Models\RepairPricing;
use App\Models\RepairService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $servicesWithPricing = RepairService::with(['pricings' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $premiumPlans = PremiumPlan::where('is_active', true)->get();

        return view('pricing', compact('servicesWithPricing', 'premiumPlans'));
    }
}
