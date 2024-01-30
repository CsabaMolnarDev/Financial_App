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
        /* Calling the other seeders */
         /* WARNING: The order matters!!! */
        $this->call([
            RoleSeeder::class,
            FinanceSeeder::class
            ]);
        /* Creating dummy users */
         \App\Models\User::factory(5)->create([
            'roles_id' => rand(2,3) /* Sets the role id when new user in generated (1=> developer version 2=> premium version 3=> basic version) */
         ]);
         /* Default developer user */
         /* Passw: 1234 */
         \App\Models\User::factory()->create([
             'fullname' => 'Laravel Dev',
             'username' => 'Dev',
             'email' => 'dev@dev.com',
             'roles_id' => 1
         ]);


    }
}
