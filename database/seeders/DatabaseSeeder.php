<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Calling the seeders */
        /* WARNING: The order matters!!! */
        $this->call([
            RoleSeeder::class,
            FamilySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            FinanceSeeder::class
        ]);
    }
}
