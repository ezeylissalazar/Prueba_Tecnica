<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_returns_view()
    {
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        $response = $this->get(route('companies.create'));

        $response->assertStatus(200);
        $response->assertViewIs('companies.create');
    }

    public function test_store_creates_company_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin'); // Asignar rol admin

        $this->actingAs($admin);

        $data = [
            'name' => 'Test Company',
            'document_type' => 1,
            'document_number' => '123456789',
            'owner' => $admin->id, // Usar el ID del admin
            'status' => '1',
        ];

        $response = $this->post(route('companies.store'), $data);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'document_number' => '123456789',
            'id_user' => $admin->id, // Verificar que el owner es el admin
        ]);

        $response->assertRedirect(route('companies'));
        $response->assertSessionHas('success', 'Successfully Registered Company');
    }

    public function test_store_creates_company_as_user()
    {
        $user = User::factory()->create();
        $user->assignRole('user'); // Asignar rol user

        $this->actingAs($user);

        $data = [
            'name' => 'Test Company',
            'document_type' => 1,
            'document_number' => '987654321',
            'status' => '1',
        ];

        $response = $this->post(route('companies.store'), $data);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'document_number' => '987654321',
            'id_user' => $user->id, // Verificar que el owner es el usuario autenticado
        ]);

        $response->assertRedirect(route('companies'));
        $response->assertSessionHas('success', 'Successfully Registered Company');
    }
}
