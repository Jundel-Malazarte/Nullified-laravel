<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RepairPricing;
use App\Models\RepairService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $services = RepairService::with('pricings')->get();

        return view('admin.pricing.index', compact('services'));
    }

    public function update(Request $request, RepairPricing $pricing)
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
            'price_label' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $pricing->update($validated);

        return back()->with('success', 'Pricing updated successfully.');
    }
}
