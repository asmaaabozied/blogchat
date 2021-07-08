<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->country,
            'code' => $this->faker->countryCode,
            'rate' => $this->faker->numberBetween(1, 5)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Country $item) {
            $url = 'https://source.unsplash.com/random/1200x800';
            $item
                ->addMediaFromUrl($url)
                ->toMediaCollection('flags');
        });
    }
}
