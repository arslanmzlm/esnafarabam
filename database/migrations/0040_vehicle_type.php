<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true)->index();
            $table->string('name')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->unsignedSmallInteger('order')->nullable();
            $table->unsignedTinyInteger('step_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
