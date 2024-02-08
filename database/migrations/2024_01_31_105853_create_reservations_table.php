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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('user_p_id')->nullable()->references('id')->on('physical_users');
            $table->foreignId('room_id')->references('id')->on('rooms');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('number_of_guests');
            $table->float('price');
            $table->string('user_type');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
