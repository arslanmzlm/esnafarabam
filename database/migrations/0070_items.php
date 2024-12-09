<?php

use App\Enums\ItemState;
use App\Enums\PhotoState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('vehicle_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedTinyInteger('state')
                ->default(ItemState::DRAFT)
                ->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedInteger('price');
            $table->unsignedInteger('kilometer');
            $table->text('description')->nullable();
            $table->foreignId('province_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('district_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('neighborhood_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('note')
                ->nullable();
            $table->dateTime('published_at')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('item_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
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

        Schema::create('item_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('file');
            $table->unsignedTinyInteger('state')
                ->index()
                ->default(PhotoState::UPLOADED);
            $table->unsignedTinyInteger('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_photos');
        Schema::dropIfExists('item_attributes');
        Schema::dropIfExists('items');
    }
};
