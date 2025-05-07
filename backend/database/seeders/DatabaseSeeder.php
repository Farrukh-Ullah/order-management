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
    \App\Models\Customer::factory(10)->create();
    \App\Models\Item::factory(20)->create();

    \App\Models\Order::factory(20)->create()->each(function ($order) {
        \App\Models\OrderItem::factory(rand(1, 5))->create([
            'order_id' => $order->id,
        ]);
    });
}
}
