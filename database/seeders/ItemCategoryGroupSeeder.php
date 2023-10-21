<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pharmacy\ItemCategoryGroup;

class ItemCategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategoryGroup::truncate();
        $data = [
            [
                'id' => 1,
                'category_group_name' => 'Pharmacy Inventory',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'category_group_name' => 'General Inventory',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),                
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        ItemCategoryGroup::insert($data);
    }
}
