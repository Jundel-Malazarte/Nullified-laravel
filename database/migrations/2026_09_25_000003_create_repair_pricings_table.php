<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('repair_services')->cascadeOnDelete();
            $table->string('device_type', 100);
            $table->decimal('price', 10, 2);
            $table->string('price_label', 50);
            $table->string('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('service_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_pricings');
    }
};