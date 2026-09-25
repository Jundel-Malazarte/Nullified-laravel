<?php

namespace App\Http\Controllers;

use App\Models\RepairService;
use App\Models\SoftwareStoreItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = RepairService::where('is_featured', true)
            ->with(['pricings' => function ($query) {
                $query->where('is_active', true);
            }])
            ->take(6)
            ->get();

        $softwareItems = SoftwareStoreItem::where('is_featured', true)
            ->take(4)
            ->get();

        return view('home', compact('featuredServices', 'softwareItems'));
    }
}
