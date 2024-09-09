<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalogue>
 */
class CatalogueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'name' => fake()->name,
            'image' => 'https://canifa.com/img/500/750/resize/6/t/6ts24s021-sw012-2-thumb-ag.webp',
            'slug' => fake()->slug,
            'is_active' => true,
            'description' => 'đsđ',
        ];
    }
}
