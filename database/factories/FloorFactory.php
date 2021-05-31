<?php

namespace Database\Factories;

use App\Models\Floor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FloorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Floor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "floor".$this->faker->unique()->numberBetween(100,999),
            'no_of_rooms' => $this->faker->numberBetween(5,10),
            'creator_id' => $this->faker->numberBetween(1000,999)
        ];
    }
}
