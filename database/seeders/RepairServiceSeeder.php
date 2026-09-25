<?php

namespace Database\Seeders;

use App\Models\RepairService;
use Illuminate\Database\Seeder;

class RepairServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Computer services
            ['category' => 'computer', 'service_name' => 'Diagnostic Check', 'short_description' => 'Full hardware and software device diagnosis', 'is_featured' => true],
            ['category' => 'computer', 'service_name' => 'OS Installation', 'short_description' => 'Clean OS installation and setup', 'is_featured' => true],
            ['category' => 'computer', 'service_name' => 'Virus Removal', 'short_description' => 'Malware and virus cleanup', 'is_featured' => true],
            ['category' => 'computer', 'service_name' => 'SSD Installation', 'short_description' => 'Upgrade to faster solid-state storage', 'is_featured' => true],
            ['category' => 'computer', 'service_name' => 'RAM Upgrade', 'short_description' => 'Boost multitasking performance', 'is_featured' => false],
            ['category' => 'computer', 'service_name' => 'Screen Replacement', 'short_description' => 'Laptop display replacement', 'is_featured' => true],
            ['category' => 'computer', 'service_name' => 'Keyboard Replacement', 'short_description' => 'Keyboard repair and replacement', 'is_featured' => false],
            ['category' => 'computer', 'service_name' => 'Motherboard Repair', 'short_description' => 'Advanced electrical board repair', 'is_featured' => true],

            // Phone services
            ['category' => 'phone', 'service_name' => 'Screen Replacement', 'short_description' => 'Display replacement for smartphones', 'is_featured' => true],
            ['category' => 'phone', 'service_name' => 'Battery Replacement', 'short_description' => 'Phone battery replacement service', 'is_featured' => true],
            ['category' => 'phone', 'service_name' => 'Charging Port', 'short_description' => 'Charging port repair', 'is_featured' => false],
            ['category' => 'phone', 'service_name' => 'Camera Repair', 'short_description' => 'Rear/front camera repair', 'is_featured' => false],
            ['category' => 'phone', 'service_name' => 'Speaker Repair', 'short_description' => 'Audio speaker issue fix', 'is_featured' => false],
            ['category' => 'phone', 'service_name' => 'Water Damage Cleaning', 'short_description' => 'Device cleaning and recovery', 'is_featured' => true],
            ['category' => 'phone', 'service_name' => 'Software Update / Flashing', 'short_description' => 'System update and firmware repair', 'is_featured' => false],

            // Tablet services
            ['category' => 'tablet', 'service_name' => 'Screen Replacement', 'short_description' => 'Tablet display replacement', 'is_featured' => false],
            ['category' => 'tablet', 'service_name' => 'Battery Replacement', 'short_description' => 'Tablet battery replacement', 'is_featured' => false],
            ['category' => 'tablet', 'service_name' => 'Charging Port', 'short_description' => 'Tablet charging port repair', 'is_featured' => false],
            ['category' => 'tablet', 'service_name' => 'Software Repair', 'short_description' => 'System troubleshooting and repair', 'is_featured' => false],
            ['category' => 'tablet', 'service_name' => 'Water Damage Repair', 'short_description' => 'Tablet cleaning and internal repair', 'is_featured' => false],

            // Software services
            ['category' => 'software', 'service_name' => 'Antivirus Premium', 'short_description' => 'Security protection and malware defense', 'is_featured' => true],
            ['category' => 'software', 'service_name' => 'Driver Pack', 'short_description' => 'Essential driver installer package', 'is_featured' => false],
            ['category' => 'software', 'service_name' => 'Remote Support', 'short_description' => 'One-on-one troubleshooting session', 'is_featured' => true],
            ['category' => 'software', 'service_name' => 'System Optimization', 'short_description' => 'Boost performance and remove clutter', 'is_featured' => false],
        ];

        foreach ($services as $service) {
            RepairService::create($service);
        }
    }
}
