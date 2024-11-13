<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = [
            ['id' => 1, 'name' => 'menunggu persetujuan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'disetujui', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('statuses')->insert($seed);
    }
}
