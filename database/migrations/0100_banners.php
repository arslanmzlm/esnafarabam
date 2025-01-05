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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(false);
            $table->unsignedTinyInteger('field');
            $table->string('title')->nullable();
            $table->string('alt_title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('body')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('link_label')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('alt')->nullable();
            $table->json('options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
