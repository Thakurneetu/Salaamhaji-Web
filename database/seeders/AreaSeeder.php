<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $areas = ['Makkah', 'Madina'];
        foreach ($areas as $area) {
          Area::create(['name' => $area]);
        }
    }
}
