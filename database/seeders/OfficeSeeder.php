<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::updateOrCreate([
            'name' => 'Head Office',
            'location' => 'Surabaya',
            'lat' => '-7.32784864318396',
            'lng' => '112.79425117905124'
        ]);

        Office::updateOrCreate([
            'name' => 'Branch Office',
            'location' => 'Sidoarjo',
            'lat' => '-7.4462462987249065',
            'lng' => '112.71844377778578'
        ]);
    }
}
