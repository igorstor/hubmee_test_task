<?php

namespace Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Entities\Post;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(2, 7)),
            'body'  => $this->faker->realText(),
        ];
    }
}
