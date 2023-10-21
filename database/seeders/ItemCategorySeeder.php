<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pharmacy\ItemCategory;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategory::truncate();
        $data = [
            [
                'id' => 1, 'category_name' => 'Medicine', 'category_group_id' => 1,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2, 'category_name' => 'Disposable', 'category_group_id' => 1,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3, 'category_name' => 'Stationary', 'category_group_id' => 2,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4, 'category_name' => 'Chemical', 'category_group_id' => 2,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5, 'category_name' => 'General', 'category_group_id' => 2,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6, 'category_name' => 'Biomedical', 'category_group_id' => 2,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7, 'category_name' => 'Linen', 'category_group_id' => 2,
                'is_active' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        ItemCategory::insert($data);
    }
}
