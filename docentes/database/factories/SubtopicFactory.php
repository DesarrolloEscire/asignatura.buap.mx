<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubtopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->text(120),
            "url" => $this->faker->url(),
            "minutes" => $this->faker->numberBetween(0, 600),
            "position" => $this->faker->numberBetween(1, 100),
        ];
    }
}
