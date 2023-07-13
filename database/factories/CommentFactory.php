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
		return [
			'comment' => $this->faker->sentence(2200),
			'user_id' => $this->faker->randomElement([1, 2, 4, 5, 6, 7]),
			'post_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
		];
	}
}
