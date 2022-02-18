<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birth_date' => $this->faker->dateTimeThisCentury('-18 years')->format('Y-m-d'),
            'company_id' => Company::all()->random()->id,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->tollFreePhoneNumber,
            'address' => $this->faker->address,
            'active' => $this->faker->randomElement([true, false]),
        ];
    }
}
