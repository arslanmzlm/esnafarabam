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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true)->index();
            $table->string('name')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->unsignedSmallInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true)->index();
            $table->foreignId('vehicle_type_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('stock_code')
                ->nullable()
                ->unique();
            $table->unsignedSmallInteger('year');
            $table->string('series');
            $table->string('model');
            $table->string('submodel')
                ->nullable();
            $table->unsignedTinyInteger('gear');
            $table->unsignedTinyInteger('fuel');
            $table->unsignedSmallInteger('engine_power');
            $table->unsignedSmallInteger('engine_size');
            $table->timestamps();
        });

        Schema::create('vehicle_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('attribute_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('attribute_value_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->json('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
