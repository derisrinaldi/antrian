<?php

namespace Database\Seeders;

use App\Models\Instansi;
use App\Models\Unit;
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
        Unit::create([
            'unit_name'=>strtoupper("admisi")
        ]);
        Unit::create([
            'unit_name'=>strtoupper("farmasi")
        ]);

        Instansi::create([
            'name'=>'Antrian'
        ]);
    }
}
