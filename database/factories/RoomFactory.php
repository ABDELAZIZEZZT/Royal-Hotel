<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->id();
        // $table->string('room_type');
        // $table->integer('room_number');
        // $table->string('status');
        // $table->string('description');
        // $table->double('price');
        // $table->string('features');
        // $table->string('name');
        // $table->float('review');
        // $table->timestamps();
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'room_type' => $this->faker->sentence(),
            'room_number' => $this->faker->unique()->numberBetween(1, 50),
            'status' => $this->faker->randomElement(['ready', 'in use', 'under maintenance']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100, 300),
            'features' => $this->faker->words(3, true),
            'name' => $this->faker->name(),
            'review' => $this->faker->numberBetween(1, 5),
            'size'=> $this->faker->numberBetween(30, 60),
            'num_guests'=>$this->faker->numberBetween(1, 5),

        ];
    }
}
