<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'website' => $this->faker->url(),
            'address' => $this->faker->address(),
            'user_id' => User::all()->random()->id,
            'logo' => 'logos/' . $this->faker->image('public/storage/logos', 640, 480, null, false),
        ];
    }
}
