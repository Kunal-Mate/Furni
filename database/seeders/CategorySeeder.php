<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['catId' => 1, 'catName' => 'Office Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 2, 'catName' => 'Office Mesh Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 3, 'catName' => 'Bar & Cafe Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 4, 'catName' => 'Dining Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 5, 'catName' => 'Study Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 6, 'catName' => 'Folding Stool', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['catId' => 7, 'catName' => '3 Seater Chair', 'isVisible' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
