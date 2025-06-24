<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Użytkownicy
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'role' => 'admin',
            'password' => bcrypt('admin'), // Change as needed
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Client',
            'email' => 'client@client',
            'role' => 'client',
            'password' => bcrypt('client'), // Change as needed
        ]);
        $clients = \App\Models\User::factory(2)->create();

        // Kategorie
        $categories = \App\Models\Category::factory(3)->create();

        // Produkty
        $products = \App\Models\Product::factory(3)->create();
        foreach ($products as $product) {
            $product->categories()->attach($categories->random(1));
        }

        // Adresy
        foreach ($clients as $client) {
            \App\Models\Address::factory()->create(['user_id' => $client->id]);
        }

        // Zamówienia
        foreach ($clients as $client) {
            $order = \App\Models\Order::create([
                'user_id' => $client->id,
                'status' => 'pending',
            ]);
            $order->products()->attach($products->random(1), [
                'quantity' => 1,
                'price_at_order' => $products->random(1)->first()->price,
            ]);
        }

        // Recenzje
        foreach ($clients as $client) {
            \App\Models\Review::create([
                'user_id' => $client->id,
                'product_id' => $products->random(1)->first()->id,
                'rating' => rand(3,5),
                'comment' => 'Super produkt!',
            ]);
        }
    }
}
