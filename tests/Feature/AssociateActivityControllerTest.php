<?php

namespace Tests\Feature;

use App\Models\ActivityByCompany;
use App\Models\Company;
use App\Models\TypeActivity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssociateActivityControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_associate_activity_returns_view_with_activities_and_associated_activities()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        // Crear una empresa de prueba
        $company = Company::factory()->create();

        // Crear algunas actividades de prueba
        $activity1 = TypeActivity::factory()->create(['name' => 'Activity 1']);
        $activity2 = TypeActivity::factory()->create(['name' => 'Activity 2']);

        // Asociar una actividad a la empresa
        ActivityByCompany::factory()->create([
            'id_company' => $company->id,
            'id_activity' => $activity1->id,
        ]);

        $response = $this->get(route('typeActivity.associate', $company->id));

        $response->assertStatus(200);
        $response->assertViewIs('type_of_activity.associate');
        $response->assertViewHas('companies', $company);
        $response->assertViewHas('activities', TypeActivity::all());
        $response->assertViewHas('associatedActivities', [$activity1->id]);
    }

    public function test_associate_activity_store_creates_associations()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        // Crear una empresa de prueba
        $company = Company::factory()->create();

        // Crear algunas actividades de prueba
        $activity1 = TypeActivity::factory()->create(['name' => 'Activity 1']);
        $activity2 = TypeActivity::factory()->create(['name' => 'Activity 2']);

        $data = [
            'activities' => [$activity1->id, $activity2->id],
        ];

        $response = $this->post(route('typeActivity.associate.store', $company->id), $data);

        $this->assertDatabaseHas('activity_by_companies', [
            'id_company' => $company->id,
            'id_activity' => $activity1->id,
        ]);

        $this->assertDatabaseHas('activity_by_companies', [
            'id_company' => $company->id,
            'id_activity' => $activity2->id,
        ]);

        $response->assertRedirect(route('companies'));
        $response->assertSessionHas('success', 'Successfully Associated Activities');
    }

    public function test_associate_activity_store_handles_errors()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        // Crear una empresa de prueba
        $company = Company::factory()->create();

        // Crear algunas actividades de prueba
        $activity1 = TypeActivity::factory()->create(['name' => 'Activity 1']);
        $activity2 = TypeActivity::factory()->create(['name' => 'Activity 2']);

        // Simular una excepción lanzada por el modelo ActivityByCompany
        $this->expectException(\Exception::class);

        ActivityByCompany::shouldReceive('create')
            ->andThrow(new \Exception('Simulated Exception'));

        $data = [
            'activities' => [$activity1->id, $activity2->id],
        ];

        $response = $this->post(route('typeActivity.associate.store', $company->id), $data);

        $this->assertDatabaseMissing('activity_by_companies', [
            'id_company' => $company->id,
            'id_activity' => $activity1->id,
        ]);

        $this->assertDatabaseMissing('activity_by_companies', [
            'id_company' => $company->id,
            'id_activity' => $activity2->id,
        ]);

        $response->assertRedirect()->back();
        $response->assertSessionHas('error', 'Failed to associate activities. Simulated Exception');
    }
}
