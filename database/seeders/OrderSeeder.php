<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            ['user_id' => 1, 'product_id' => 6,  'qty' => 3,  'total_price' => 10500,  'status' => 'completed', 'created_at' => now()->subDays(5)],
            ['user_id' => 1, 'product_id' => 11, 'qty' => 2,  'total_price' => 70000,  'status' => 'completed', 'created_at' => now()->subDays(4)],
            ['user_id' => 1, 'product_id' => 7,  'qty' => 1,  'total_price' => 6000,   'status' => 'completed', 'created_at' => now()->subDays(4)],
            ['user_id' => 1, 'product_id' => 6,  'qty' => 5,  'total_price' => 17500,  'status' => 'completed', 'created_at' => now()->subDays(3)],
            ['user_id' => 1, 'product_id' => 1,  'qty' => 2,  'total_price' => 17000,  'status' => 'completed', 'created_at' => now()->subDays(3)],
            ['user_id' => 1, 'product_id' => 15, 'qty' => 1,  'total_price' => 75000,  'status' => 'completed', 'created_at' => now()->subDays(2)],
            ['user_id' => 1, 'product_id' => 6,  'qty' => 10, 'total_price' => 35000,  'status' => 'completed', 'created_at' => now()->subDays(2)],
            ['user_id' => 1, 'product_id' => 18, 'qty' => 1,  'total_price' => 125000, 'status' => 'completed', 'created_at' => now()->subDays(1)],
            ['user_id' => 1, 'product_id' => 12, 'qty' => 2,  'total_price' => 90000,  'status' => 'pending',   'created_at' => now()->subHours(5)],
            ['user_id' => 1, 'product_id' => 22, 'qty' => 1,  'total_price' => 22000,  'status' => 'pending',   'created_at' => now()->subHours(3)],
            ['user_id' => 1, 'product_id' => 7,  'qty' => 4,  'total_price' => 24000,  'status' => 'completed', 'created_at' => today()],
            ['user_id' => 1, 'product_id' => 6,  'qty' => 2,  'total_price' => 7000,   'status' => 'pending',   'created_at' => today()],
            ['user_id' => 1, 'product_id' => 21, 'qty' => 3,  'total_price' => 24000,  'status' => 'completed', 'created_at' => today()],
        ];

        foreach ($orders as $order) {
            DB::table('orders')->insert(array_merge($order, [
                'updated_at' => $order['created_at'],
            ]));
        }
    }
}
