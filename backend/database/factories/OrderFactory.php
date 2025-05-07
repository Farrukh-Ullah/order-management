<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer; // Add this line to import the Customer model
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // Now it will work correctly
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'order_date' => $this->faker->date(),
        ];
    }
}
