<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $name = $this->faker->productName ?? $this->faker->words(3, true); // fallback if no product provider
    return [
        'name' => $name,
        'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1,9999),
        'description' => $this->faker->paragraphs(2, true),
        'price' => $this->faker->randomFloat(2, 5, 500),
        'stock' => $this->faker->numberBetween(0, 200),
        'sku' => strtoupper($this->faker->bothify('SKU-??-#####')),
    ];
}}
