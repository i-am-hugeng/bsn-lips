<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jenisStandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_standar')->insert([
            ['jenis_standar' => 'SNI'],
            ['jenis_standar' => 'ASTM'],
//            ['jenis_standar' => 'BS'],
//            ['jenis_standar' => 'DIN'],
//            ['jenis_standar' => 'EN'],
            ['jenis_standar' => 'IEC'],
            ['jenis_standar' => 'ISO'],
//            ['jenis_standar' => 'IUMSS'],
//            ['jenis_standar' => 'IWA'],
//            ['jenis_standar' => 'JIS'],
//            ['jenis_standar' => 'TAPPI'],
//            ['jenis_standar' => 'TIP'],
            ['jenis_standar' => 'Lainnya'],
        ]);
    }
}
