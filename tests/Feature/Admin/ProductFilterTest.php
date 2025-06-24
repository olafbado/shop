<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_filter_products_by_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $cat1 = Category::factory()->create();
        $cat2 = Category::factory()->create();
        $product1 = Product::factory()->create(['name' => 'UniqueProductOne']);
        $product2 = Product::factory()->create(['name' => 'UniqueProductTwo']);
        $product1->categories()->attach($cat1);
        $product2->categories()->attach($cat2);
        $this->actingAs($admin)
            ->get('/admin/products?category=' . $cat1->id)
            ->assertSeeText('UniqueProductOne')
            ->assertDontSeeText('UniqueProductTwo');
    }
}
