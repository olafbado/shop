<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_middleware_allows_only_admin_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk();

        $client = User::factory()->create(['role' => 'client']);
        $this->actingAs($client)
            ->get('/admin/dashboard')
            ->assertForbidden();
    }

    public function test_client_middleware_allows_only_client_users()
    {
        $client = User::factory()->create(['role' => 'client']);
        $this->actingAs($client)
            ->get('/client/panel')
            ->assertOk();

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)
            ->get('/client/panel')
            ->assertForbidden();
    }

    public function test_registration_assigns_client_role_by_default()
    {
        $user = User::factory()->create();
        $this->assertEquals('client', $user->role);
    }

    public function test_login_redirects_based_on_role()
    {
        $admin = User::factory()->create(['role' => 'admin', 'password' => bcrypt('password')]);
        $client = User::factory()->create(['role' => 'client', 'password' => bcrypt('password')]);

        $this->post('/login', ['email' => $admin->email, 'password' => 'password'])
            ->assertRedirect('/admin/dashboard');
        $this->post('/logout');
        $this->post('/login', ['email' => $client->email, 'password' => 'password'])
            ->assertRedirect('/client/panel');
    }
}
