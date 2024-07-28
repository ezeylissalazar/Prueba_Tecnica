<?php

namespace Database\Factories;

use App\Models\ActivityByCompany;
use App\Models\Company;
use App\Models\TypeActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityByCompany>
 */
class ActivityByCompanyFactory extends Factory
{
    protected $model = ActivityByCompany::class;

    public function definition()
    {
        return [
            'id_company' => Company::factory(),
            'id_activity' => TypeActivity::factory(),
        ];
    }
}
