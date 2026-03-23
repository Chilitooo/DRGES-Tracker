<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\StockIn;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create staff users
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
            'status' => 'active',
        ]);

        // Create sample products
        $products = [
            ['sku' => 'P001', 'name' => 'Aspirin 500mg', 'category' => 'Pain Relief', 'unit' => 'box', 'selling_price' => 5.99, 'safety_stock' => 20],
            ['sku' => 'P002', 'name' => 'Vitamins C', 'category' => 'Supplements', 'unit' => 'bottle', 'selling_price' => 12.99, 'safety_stock' => 15],
            ['sku' => 'P003', 'name' => 'Bandages', 'category' => 'First Aid', 'unit' => 'box', 'selling_price' => 3.50, 'safety_stock' => 50],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }

        // Add initial stock
        $products = Product::all();
        foreach ($products as $p) {
            StockIn::create([
                'product_id' => $p->id,
                'quantity' => 100,
                'batch_number' => 'BATCH001',
                'user_id' => $admin->id,
            ]);
        }
    }
}
