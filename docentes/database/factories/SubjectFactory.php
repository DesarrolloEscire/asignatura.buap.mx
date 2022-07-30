<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => collect(['Desarrollo de Habilidades del Pensamiento Complejo', 'Formación Humana y Social'])->random(),
            "key" => $this->faker->regexify('[A-Z]{4}\-[0-9]{3}'),
            "purpose" => $this->faker->text(200),
            "type" => collect(['creación', 'actualización','digitalización'])->random(),
            "theoretical_hours" => $this->faker->numberBetween(10,72),
            "practical_hours" => $this->faker->numberBetween(10,72),
        ];
    }
}
