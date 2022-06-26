<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;


class FakerMenu extends Seeder
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
            DB::table('menus')->insert([
                'nama'  => $faker->userName,
                'stock' => $faker->numberBetween(10,50),
                'harga' => $faker->numberBetween(10000,100000),
                'img'   =>  'https://pondokindahmall.co.id/assets/img/default.png',
            ]);
        }
    }
}
