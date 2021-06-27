<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Hotel Bintang 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Bintang 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Bintang 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Bintang 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Bintang 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Melati',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Category::insert($categories);
    }
}
