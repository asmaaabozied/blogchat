<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\FamilyBlog;
use App\Models\Group;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // this->call(Seeder)
        $this->call(AdminSeeder::class);
        Country::factory()->hasUsers(3)->count(10)->create();
        Category::factory()->count(10)->create();
        Group::factory()->count(10)->create();
        Post::factory()->count(10)->create();
        Comment::factory()->count(10)->create();
       FamilyBlog::factory()->count(10)->create();
        Reply::factory()->count(10)->create();
    }
}
