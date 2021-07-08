<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'image' => 'images/default.png',
            'is_paid' => $this->faker->boolean,
            'order' => $this->faker->numberBetween(1, 50),
            'place' => $this->faker->randomElement(['up', 'down']),
        ];
    }
}
