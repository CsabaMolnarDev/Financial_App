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
            'roles_id' => rand(2,3), /* Sets the role id when new user in generated (1=> developer version 2=> premium version 3=> basic version) */
            
         ]);
         /* Default developer user */
         /* Passw: 1234 */
         \App\Models\User::factory()->create([
            'fullname' => 'Molnár Csaba',
            'username' => 'Frontend deeloper',
            'phone' => '+36 00 000 0001',
            'picture' => 'pic1',
            'email' => 'frontenddeeloper@dev.com',
            'roles_id' => 1,
            
         ]);
         \App\Models\User::factory()->create([
            'fullname' => 'Láng Ricsi',
            'username' => 'Ideamaker/backend developer',
            'phone' => '+36 00 000 0002',
            'picture' => 'pic2',
            'email' => 'ideamakerdeveloper@dev.com',
            'roles_id' => 1,
            
        ]);
        \App\Models\User::factory()->create([
            'fullname' => 'Ambrus Dobai Kristóf',
            'username' => 'Backend Developer',
            'phone' => '+36 00 000 0003',
            //'picture' => 'pic3',
            'email' => 'backenddeveloper@dev.com',
            'roles_id' => 1,
           
        ]);


    }
}
