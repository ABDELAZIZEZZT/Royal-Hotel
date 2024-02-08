<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->id();
        // $table->foreignId('user_id')->references('id')->on('users');;
        // $table->foreignId('room_id')->references('id')->on('rooms');;
        // $table->dateTime('check_in');
        // $table->dateTime('check_out');
        // $table->integer('number_of_guests');
        // $table->float('price');
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'user_id'=>User::factory(),
            'room_id'=>Room::factory(),
            'check_in'=>fake()->dateTime(),
            'check_out'=>fake()->dateTime(),
            'number_of_guests'=>fake()->numberBetween(1,6),
            'price'=>fake()->numberBetween(100,3000)
            //
        ];
    }
}
