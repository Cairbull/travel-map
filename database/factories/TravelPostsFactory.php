<?php

namespace Database\Factories;

use App\Models\TravelPosts;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelPostsFactory extends Factory
{
    protected $model = TravelPosts::class;
  
    public function definition(): array
    {
        return [
            'joomla_id' => fake()->unique()->numberBetween(1, 100000),
            'title' => fake()->sentence(),
            'alias' => fake()->slug(),
            'introtext' => fake()->paragraph(),
            'publish_up' => fake()->dateTime(),
            'images' => null,
            'country' => fake()->country(),
            'city' => fake()->city(),
            'coordinates' => fake()->latitude() . ',' . fake()->longitude(),
            'joomla_modified' => fake()->dateTime(),
        ];
    }
}
