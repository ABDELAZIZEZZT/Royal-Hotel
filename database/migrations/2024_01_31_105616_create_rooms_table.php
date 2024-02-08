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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');
            $table->integer('room_number')->unique();
            $table->string('status');
            $table->string('description');
            $table->double('price');
            $table->string('features');
            $table->string('name');
            $table->foreignId('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->integer('periority');   
            $table->float('review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
