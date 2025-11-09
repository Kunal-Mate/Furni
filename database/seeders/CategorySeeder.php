<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // $categories = [
        //     // Start of data from CSV
        //     [
        //         'catId' => 1,
        //         'catName' => 'Office Chair',
        //         'catImg' => 'frontend/assets/category/Office Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 2,
        //         'catName' => 'Office Mesh Chair',
        //         'catImg' => 'frontend/assets/category/Office Mesh Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 3,
        //         'catName' => 'Bar & Cafe Chair',
        //         'catImg' => 'frontend/assets/category/Bar & Cafe Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 4,
        //         'catName' => 'Dining Chair',
        //         'catImg' => 'frontend/assets/category/Dining Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 5,
        //         'catName' => 'Study Chair',
        //         'catImg' => 'frontend/assets/category/Study Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 6,
        //         'catName' => 'Folding Stool',
        //         'catImg' => 'frontend/assets/category/Folding Stool.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ],
        //     [
        //         'catId' => 7,
        //         'catName' => 'Waiting Chair',
        //         'catImg' => 'frontend/assets/category/Waiting Chair.jfif',
        //         'isVisible' => 1,
        //         'created_at' => '2025-10-29 17:53:55',
        //         'updated_at' => '2025-10-29 17:53:55'
        //     ]
        //     // End of data from CSV
        // ];

        // // Chunking the inserts for better performance on large datasets
        // foreach (array_chunk($categories, 100) as $chunk) {
        //     DB::table('categories')->insert($chunk);
        // }

        $path = database_path('seeders/data/categories.csv');
        if (!File::exists($path)) {
            $this->command->error("File not found: $path");
            return;
        }

        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        foreach ($data as $row) {
            $category = array_combine($header, $row);

            DB::table('categories')->insert([
                'catId' => $category['catId'] ?? null,
                'catName' => $category['catName'] ?? null,
                'catImg' => $category['catImg'] ?? null,
                'isVisible' => $category['isVisible'] ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Categories table seeded successfully.');
    }
}
