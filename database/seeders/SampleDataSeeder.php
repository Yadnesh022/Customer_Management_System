<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 customers
        $customers = Customer::factory(20)->create();

        // Create 50 orders distributed among customers
        foreach ($customers as $customer) {
            Order::factory(rand(1, 5))->create([
                'customer_id' => $customer->id,
            ]);
        }
    }
}