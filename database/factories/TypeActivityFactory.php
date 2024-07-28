<?php

namespace Database\Factories;

use App\Models\TypeActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeActivity>
 */
class TypeActivityFactory extends Factory
{
    protected $model = TypeActivity::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
