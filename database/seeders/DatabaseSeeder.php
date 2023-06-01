<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            ProvinsiSeeder::class,
            KotaSeeder::class,
            StatusSeeder::class
        ]);
    }
}
