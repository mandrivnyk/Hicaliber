<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(($file = fopen("././data/property-data.csv", 'r')) != FALSE) {

            while (($row = fgetcsv($file, 0,',')) != FALSE){
                DB::table('houses')->insert(
                    array(
                        'Name' => $row[0],
                        'Price' => $row[1],
                        'Bedrooms' => $row[2],
                        'Bathrooms' => $row[3],
                        'Storeys' => $row[4],
                        'Garages' => $row[5]
                    )
                );
            }
        }
    }
}
