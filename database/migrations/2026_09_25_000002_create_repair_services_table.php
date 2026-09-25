<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_services', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['computer', 'phone', 'tablet', 'accessory', 'software']);
            $table->string('service_name', 150);
            $table->string('short_description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_services');
    }
};
