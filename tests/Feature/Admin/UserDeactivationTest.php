<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDeactivationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_deactivate_and_reactivate_users()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['active' => 1]);
        $this->actingAs($admin)
            ->patch("/admin/users/{$user->id}/toggle")
            ->assertRedirect();
        $user->refresh();
        $this->assertFalse((bool) $user->active);
        $this->patch("/admin/users/{$user->id}/toggle");
        $user->refresh();
        $this->assertTrue((bool) $user->active);
    }
}
