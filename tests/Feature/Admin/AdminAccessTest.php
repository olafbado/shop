<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard_and_modules()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk();
        $this->get('/admin/users')->assertOk();
        $this->get('/admin/products')->assertOk();
        $this->get('/admin/categories')->assertOk();
        $this->get('/admin/orders')->assertOk();
        $this->get('/admin/reviews')->assertOk();
    }

    public function test_client_cannot_access_admin_dashboard()
    {
        $client = User::factory()->create(['role' => 'client']);
        $this->actingAs($client)
            ->get('/admin/dashboard')
            ->assertForbidden();
    }

    public function test_guest_cannot_access_admin_dashboard()
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }
}
