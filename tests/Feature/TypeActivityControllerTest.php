<?php

namespace Tests\Feature;

use App\Models\TypeActivity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TypeActivityControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_returns_view_with_type_of_activities()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        // Crear algunas actividades de prueba
        TypeActivity::factory()->create(['name' => 'Admin']);
        TypeActivity::factory()->create(['name' => 'User']);

        $response = $this->get(route('typeActivity'));

        $response->assertStatus(200);
        $response->assertViewIs('type_of_activity.index');
        $response->assertViewHas('type_of_activity');
    }

    public function test_create_returns_view_with_users()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        $response = $this->get(route('typeActivity.create'));

        $response->assertStatus(200);
        $response->assertViewIs('type_of_activity.create');
        $response->assertViewHas('users');
    }

    public function test_store_creates_type_activity()
    {
        // Crear un usuario y autenticarlo
        $user = User::factory()->create();
        $user->assignRole('admin'); // Asignar rol admin

        $this->actingAs($user);

        $data = [
            'name' => 'Test Activity'
        ];

        $response = $this->post(route('typeActivity.store'), $data);

        $this->assertDatabaseHas('type_activities', [
            'name' => 'Test Activity',
        ]);

        $response->assertRedirect(route('typeActivity'));
        $response->assertSessionHas('success', 'Successfully Registered Activity');
    }

}
