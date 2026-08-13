<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceRequestCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_uses_active_companies_and_departments_from_database(): void
    {
        $company = Company::create([
            'name' => 'Empresa Real',
            'docto' => '00.000.000/0001-00',
            'address' => 'Rua Principal, 100',
            'is_active' => true,
        ]);

        $department = Department::create([
            'name' => 'Suporte',
            'company_id' => $company->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('servicerequest.create'));

        $response->assertOk()
            ->assertSee('Empresa Real')
            ->assertSee('Suporte')
            ->assertDontSee('Empresa A');
    }

    public function test_service_request_is_persisted_with_selected_records(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Empresa Real',
            'docto' => '00.000.000/0001-00',
            'address' => 'Rua Principal, 100',
            'is_active' => true,
        ]);

        $department = Department::create([
            'name' => 'Suporte',
            'company_id' => $company->id,
            'is_active' => true,
        ]);

        $response = $this->post(route('servicerequest.store'), [
            'empresa_id' => $company->id,
            'departamento_id' => $department->id,
            'prioridade' => 'alta',
            'descricao' => 'Instalar o sistema no computador da recepção.',
        ]);

        $response->assertRedirect(route('servicerequest.index'));
        $this->assertDatabaseHas('requests', [
            'company_id' => $company->id,
            'department_id' => $department->id,
            'user_id' => $user->id,
            'priority' => 'alta',
            'status' => 'open',
        ]);
    }
}
