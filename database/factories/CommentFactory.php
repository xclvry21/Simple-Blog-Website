<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = rand(1, 10);
        $post_id = rand(1, 100);
        return [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'body' => $this->faker->text(50)
        ];
    }
}
