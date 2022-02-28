<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            //'product_category_id' => Category::all()->random()->id,
            'price' => $this->faker->numberBetween($min = 50, $max = 1000),
            'quantity' => $this->faker->numberBetween($min = 1, $max = 50),
        ];
    }
}
