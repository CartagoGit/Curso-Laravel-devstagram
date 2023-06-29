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
		return [
			//* -> Para cargar los alias de composer directamente para wsl
			// composer dump-autoload

			//* -> Para ejecutar el factory
			//* sail artisan tinker
			// Post::factory()->count(100)->create();
			'title' => $this->faker->sentence(5),
			'description' => $this->faker->sentence(20),
			'image' => public_path('uploads/images') . '/' . $this->faker->uuid() . '.jpg',
			'user_id' => $this->faker->randomElement([1, 2, 4, 5, 6, 7]),
		];
	}
}
