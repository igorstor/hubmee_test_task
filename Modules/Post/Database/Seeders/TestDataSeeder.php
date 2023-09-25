<?php

namespace Modules\Post\Database\Seeders;

use Modules\Post\Entities\User;
use Illuminate\Database\Seeder;
use Modules\Post\Entities\Post;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Post::factory()->count(10))
            ->count(50)
            ->create();
    }
}
