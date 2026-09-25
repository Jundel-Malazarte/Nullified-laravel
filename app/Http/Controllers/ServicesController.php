<?php

namespace App\Http\Controllers;

use App\Models\RepairService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = RepairService::with(['pricings' => function ($q) {
            $q->where('is_active', true);
        }]);

        if ($category && in_array($category, ['computer', 'phone', 'tablet', 'accessory', 'software'])) {
            $query->where('category', $category);
        }

        $services = $query->get()->groupBy('category');

        return view('services', compact('services', 'category'));
    }

    public function show(RepairService $service)
    {
        $service->load(['pricings' => function ($q) {
            $q->where('is_active', true);
        }]);

        return view('services.show', compact('service'));
    }
}
