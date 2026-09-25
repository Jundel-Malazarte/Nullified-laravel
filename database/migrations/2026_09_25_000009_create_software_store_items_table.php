<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_store_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 150);
            $table->string('category', 100);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_store_items');
    }
};
