<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'code' => 'APP20241100001',
            'name' => 'Ana',
            'email' => 'ana@app.serv',
            'role' => 'Approver',
            'password' => bcrypt('approver1'),
        ]);

        \App\Models\User::factory()->create([
            'code' => 'APP20241100002',
            'name' => 'Ani',
            'email' => 'ani@app.serv',
            'role' => 'Approver',
            'password' => bcrypt('approver2'),
        ]);

        \App\Models\User::factory()->create([
            'code' => 'APP20241100003',
            'name' => 'Ina',
            'email' => 'ina@app.serv',
            'role' => 'Approver',
            'password' => bcrypt('approver3'),
        ]);

        $this->call(StatusSeeder::class);
    }
}
