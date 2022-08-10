<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            'المجدل',
            'غزة',
            'رفح',
            'خانيونس',
            'القدس',
            'الخليل',
            'طولكرم',
            'نابلس',
            'جنين',
        );

        foreach ($cities as $city){
            DB::table('cities')->insert([
                'name' => $city,
                'country_id' => 187,
            ]);
        }
    }
}
