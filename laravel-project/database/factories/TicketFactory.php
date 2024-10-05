<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::factory(),
            'movie_id'=>$this->faker->numberBetween(10000000,99999999),
            'name'=>$this->faker->name(),
            'seat'=>json_encode($this->faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50])),
            'theater'=>$this->faker->text(8),
            'price'=>$this->faker->randomFloat(2,6,10),
            'date'=>$this->faker->date(),
            'time'=>$this->faker->time()
        ];
    }
}
