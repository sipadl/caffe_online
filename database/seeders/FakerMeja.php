<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class FakerMeja extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i < 10; $i++){
            DB::table('mejas')->insert([
                'no_meja'   => $i,
                'status'    => 'active'
            ]);
        }
    }
}
