<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'document_type' => $this->faker->randomElement([1, 2, 3]),
            'document_number' => $this->faker->unique()->numerify('#########'),
            'id_user' => User::factory(), 
            'status' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
