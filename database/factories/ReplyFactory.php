<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\FamilyBlog;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'family_blog_id' => FamilyBlog::factory(),
            'content' => $this->faker->text,
            'repliable_type'=>$this->faker->mimeType,
            'repliable_id'=>$this->faker->numberBetween(1, 5),
        ];
    }
}
