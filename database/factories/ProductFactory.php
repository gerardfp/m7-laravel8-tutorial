<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'desc' => $this->faker->text(200),
            'price' => rand(2,15),
            'imagen' => $this->faker->imageUrl($width = 400, $height = 400),
            'type' => $this->faker->name(),
        ];
    }
}
