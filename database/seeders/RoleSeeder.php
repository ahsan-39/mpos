<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        Role::create(['id' => 1, 'name' => 'Super Admin','slug' => 'super-admin']);
        Role::create(['id' => 2, 'name' => 'Inventory Manager', 'slug' => 'inventory-manager']);
        Role::create(['id' => 3, 'name' => 'Dispenser', 'slug' => 'dispenser']);
    }
}
