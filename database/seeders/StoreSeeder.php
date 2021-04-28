<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        Store::truncate();
        $faker = Faker::create();
        for ($i=0; $i < 20; $i++) { 
            Store::create([
                'key' => $faker->regexify('[A-Z0-9]{8}'),
                'value' => $faker->regexify('[A-Z0-9]{100}'),
            ]);
        }
    }
}
