<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = rand(1, 10);
        $pic_id = rand(0, 1500);

        return [
            'user_id' => $user_id,
            'title' => $this->faker->sentence(),
            'photo_path' => "https://picsum.photos/800/600?random=$pic_id",
            'body' => $this->faker->text()
        ];
    }
}
