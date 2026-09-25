<?php

namespace Database\Seeders;

use App\Models\RepairPricing;
use Illuminate\Database\Seeder;

class RepairPricingSeeder extends Seeder
{
    public function run(): void
    {
        $pricings = [
            ['service_id' => 1, 'device_type' => 'Computer / Laptop', 'price' => 300.00, 'price_label' => '₱300', 'notes' => 'Initial diagnostic fee'],
            ['service_id' => 2, 'device_type' => 'Computer / Laptop', 'price' => 500.00, 'price_label' => '₱500', 'notes' => 'Operating system installation'],
            ['service_id' => 3, 'device_type' => 'Computer / Laptop', 'price' => 700.00, 'price_label' => '₱700', 'notes' => 'Malware and virus cleanup'],
            ['service_id' => 4, 'device_type' => 'Computer / Laptop', 'price' => 600.00, 'price_label' => '₱600', 'notes' => 'SSD upgrade service'],
            ['service_id' => 5, 'device_type' => 'Computer / Laptop', 'price' => 500.00, 'price_label' => '₱500', 'notes' => 'Performance memory upgrade'],
            ['service_id' => 6, 'device_type' => 'Computer / Laptop', 'price' => 2500.00, 'price_label' => '₱2,500+', 'notes' => 'Price depends on display model'],
            ['service_id' => 7, 'device_type' => 'Computer / Laptop', 'price' => 1200.00, 'price_label' => '₱1,200+', 'notes' => 'Keyboard replacement varies by model'],
            ['service_id' => 8, 'device_type' => 'Computer / Laptop', 'price' => 3500.00, 'price_label' => '₱3,500+', 'notes' => 'Complex motherboard repair'],
            ['service_id' => 9, 'device_type' => 'Mobile Phone', 'price' => 1500.00, 'price_label' => '₱1,500+', 'notes' => 'Display replacement on common models'],
            ['service_id' => 10, 'device_type' => 'Mobile Phone', 'price' => 1000.00, 'price_label' => '₱1,000+', 'notes' => 'Battery replacement service'],
            ['service_id' => 11, 'device_type' => 'Mobile Phone', 'price' => 800.00, 'price_label' => '₱800+', 'notes' => 'Port repair and cleaning'],
            ['service_id' => 12, 'device_type' => 'Mobile Phone', 'price' => 1200.00, 'price_label' => '₱1,200+', 'notes' => 'Camera replacement and calibration'],
            ['service_id' => 13, 'device_type' => 'Mobile Phone', 'price' => 700.00, 'price_label' => '₱700+', 'notes' => 'Speaker repair and replacement'],
            ['service_id' => 14, 'device_type' => 'Mobile Phone', 'price' => 1500.00, 'price_label' => '₱1,500+', 'notes' => 'Internal cleaning and recovery'],
            ['service_id' => 15, 'device_type' => 'Mobile Phone', 'price' => 600.00, 'price_label' => '₱600', 'notes' => 'Update and flashing support'],
            ['service_id' => 16, 'device_type' => 'Tablet', 'price' => 2500.00, 'price_label' => '₱2,500+', 'notes' => 'Tablet screen replacement'],
            ['service_id' => 17, 'device_type' => 'Tablet', 'price' => 1500.00, 'price_label' => '₱1,500+', 'notes' => 'Tablet battery replacement'],
            ['service_id' => 18, 'device_type' => 'Tablet', 'price' => 900.00, 'price_label' => '₱900+', 'notes' => 'Charging port issue fix'],
            ['service_id' => 19, 'device_type' => 'Tablet', 'price' => 700.00, 'price_label' => '₱700', 'notes' => 'Software repair and troubleshooting'],
            ['service_id' => 20, 'device_type' => 'Tablet', 'price' => 1800.00, 'price_label' => '₱1,800+', 'notes' => 'Water damage and deep cleaning'],
            ['service_id' => 21, 'device_type' => 'Software', 'price' => 799.00, 'price_label' => '₱799', 'notes' => 'Premium malware protection'],
            ['service_id' => 22, 'device_type' => 'Software', 'price' => 499.00, 'price_label' => '₱499', 'notes' => 'Driver pack for system support'],
            ['service_id' => 23, 'device_type' => 'Software', 'price' => 1500.00, 'price_label' => '₱1,500', 'notes' => 'Remote tech support session'],
            ['service_id' => 24, 'device_type' => 'Software', 'price' => 899.00, 'price_label' => '₱899', 'notes' => 'Performance optimization service'],
        ];

        foreach ($pricings as $pricing) {
            RepairPricing::create($pricing);
        }
    }
}
