<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Manager
        User::firstOrCreate(
            ['email' => 'manager@smart.co.id'],
            [
                'name' => 'Manager Ops',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]
        );

        // Sales
        User::firstOrCreate(
            ['email' => 'sales@smart.co.id'],
            [
                'name' => 'Sales Staff',
                'password' => Hash::make('password'),
                'role' => 'sales',
            ]
        );

        // Products
        $products = [
            [
                'name' => 'Home Fiber 20Mbps',
                'description' => 'Cocok untuk penggunaan ringan',
                'price' => 250000,
                'bandwidth_mbps' => 20,
            ],
            [
                'name' => 'Home Fiber 50Mbps',
                'description' => 'Streaming 4K lancar',
                'price' => 375000,
                'bandwidth_mbps' => 50,
            ],
            [
                'name' => 'Bisnis Dedicated 100Mbps',
                'description' => 'IP Static Public included',
                'price' => 1500000,
                'bandwidth_mbps' => 100,
            ]
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
