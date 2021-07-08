<?php

namespace Database\Factories;
use App\Models\Model;
use App\Models\FamilyBlog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class FamilyBlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FamilyBlog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
