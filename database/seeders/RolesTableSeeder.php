<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Klant']);
        Role::create(['name' => 'Developer']);
        Role::create(['name' => 'Designer']);
    }
}
