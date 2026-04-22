<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Obat Keras (category_id: 1)
            ['name' => 'Amoxicillin 500mg',       'category_id' => 1, 'price' => 8500,   'stock' => 200, 'is_active' => true],
            ['name' => 'Metformin 500mg',          'category_id' => 1, 'price' => 5000,   'stock' => 150, 'is_active' => true],
            ['name' => 'Amlodipine 5mg',           'category_id' => 1, 'price' => 12000,  'stock' => 80,  'is_active' => true],
            ['name' => 'Captopril 25mg',           'category_id' => 1, 'price' => 7500,   'stock' => 3,   'is_active' => true],  // low stock
            ['name' => 'Omeprazole 20mg',          'category_id' => 1, 'price' => 9000,   'stock' => 0,   'is_active' => false], // nonaktif

            // Obat Bebas (category_id: 2)
            ['name' => 'Paracetamol 500mg',        'category_id' => 2, 'price' => 3500,   'stock' => 500, 'is_active' => true],
            ['name' => 'Ibuprofen 400mg',          'category_id' => 2, 'price' => 6000,   'stock' => 300, 'is_active' => true],
            ['name' => 'Antasida Tablet',          'category_id' => 2, 'price' => 4500,   'stock' => 250, 'is_active' => true],
            ['name' => 'Obat Batuk Sirup 100ml',   'category_id' => 2, 'price' => 18000,  'stock' => 2,   'is_active' => true],  // low stock
            ['name' => 'CTM 4mg',                  'category_id' => 2, 'price' => 2000,   'stock' => 400, 'is_active' => true],

            // Suplemen & Vitamin (category_id: 3)
            ['name' => 'Vitamin C 1000mg',         'category_id' => 3, 'price' => 35000,  'stock' => 120, 'is_active' => true],
            ['name' => 'Vitamin D3 1000IU',        'category_id' => 3, 'price' => 45000,  'stock' => 90,  'is_active' => true],
            ['name' => 'Zinc 20mg',                'category_id' => 3, 'price' => 28000,  'stock' => 60,  'is_active' => true],
            ['name' => 'Minyak Ikan Omega-3',      'category_id' => 3, 'price' => 55000,  'stock' => 4,   'is_active' => true],  // low stock
            ['name' => 'Multivitamin Dewasa',      'category_id' => 3, 'price' => 75000,  'stock' => 110, 'is_active' => true],

            // Alat Kesehatan (category_id: 4)
            ['name' => 'Masker Medis 3 Ply (50pcs)', 'category_id' => 4, 'price' => 35000, 'stock' => 200, 'is_active' => true],
            ['name' => 'Sarung Tangan Latex (100pcs)','category_id' => 4, 'price' => 85000, 'stock' => 75,  'is_active' => true],
            ['name' => 'Termometer Digital',         'category_id' => 4, 'price' => 125000,'stock' => 30,  'is_active' => true],
            ['name' => 'Tensimeter Digital',         'category_id' => 4, 'price' => 350000,'stock' => 1,   'is_active' => true],  // low stock
            ['name' => 'Pulse Oximeter',             'category_id' => 4, 'price' => 175000,'stock' => 20,  'is_active' => true],

            // Perawatan Luka (category_id: 5)
            ['name' => 'Plester Luka 10pcs',       'category_id' => 5, 'price' => 8000,   'stock' => 350, 'is_active' => true],
            ['name' => 'Betadine 30ml',            'category_id' => 5, 'price' => 22000,  'stock' => 180, 'is_active' => true],
            ['name' => 'Kasa Steril 10x10',        'category_id' => 5, 'price' => 5500,   'stock' => 400, 'is_active' => true],
            ['name' => 'Alkohol 70% 100ml',        'category_id' => 5, 'price' => 15000,  'stock' => 220, 'is_active' => true],
            ['name' => 'Perban Elastis 8cm',       'category_id' => 5, 'price' => 12000,  'stock' => 0,   'is_active' => false], // nonaktif
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
