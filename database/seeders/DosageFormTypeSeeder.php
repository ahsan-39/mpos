<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pharmacy\ItemDosageFormType;
use Illuminate\Database\Seeder;

class DosageFormTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemDosageFormType::truncate();
        $data = [
            [
                'id' => 1,
                'dosage_form_type_name' => 'Calculated',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'dosage_form_type_name' => 'Fixed',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),                
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        ItemDosageFormType::insert($data);   
    }
}
