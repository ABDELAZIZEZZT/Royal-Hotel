<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feature_reservation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->nullable()->references('id')->on('reservations');
            $table->foreignId('features_id')->nullable()->references('id')->on('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_reservation');
    }
};
