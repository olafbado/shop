<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_edit_products()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'Test desc',
            'price' => 10.99,
            'stock' => 5,
            'active' => 1,
        ]);
        $response->assertRedirect('/admin/products');
        $product = Product::where('name', 'Test Product')->first();
        $this->assertNotNull($product);

        $response = $this->put("/admin/products/{$product->id}", [
            'name' => 'Updated Product',
            'description' => 'Updated desc',
            'price' => 20.99,
            'stock' => 10,
            'active' => 1,
        ]);
        $response->assertRedirect('/admin/products');
        $product->refresh();
        $this->assertEquals('Updated Product', $product->name);
    }

    public function test_admin_can_deactivate_a_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create(['active' => 1]);
        $this->actingAs($admin)
            ->patch("/admin/products/{$product->id}/toggle")
            ->assertRedirect();
        $product->refresh();
        $this->assertFalse((bool) $product->active);
    }
}
