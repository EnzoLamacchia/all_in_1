<?php

namespace Database\Seeders;

use App\Models\Data\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $json = File::get(base_path('database/data/countries.json'));
        $data = json_decode($json,true);
        foreach ($data['countries']['country'] as $obj) {
            Country::create(array(
                'code' => $obj['countryCode'],
                'name' => $obj['countryName'],
                'capital' => $obj['capital'],
                'isoNumeric' => $obj['isoNumeric'],
                'continentName' => $obj['continentName'],
                'continentCode' => $obj['continent'],
            ));
        }
    }
}
