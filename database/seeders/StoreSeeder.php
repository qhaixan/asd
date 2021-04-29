<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

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
        for ($i=0; $i < 50; $i++) {
            $time = $this->randomTime();
            Store::create([
                'key' => $faker->regexify('[A-Z]{1}'),
                'value' => $faker->name(),
                'created_at' => $time,
                'updated_at' => $time
            ]);
        }
    }

    private function randomTime(){
        $year = rand(2020, 2020);
        $month = rand(1, 12);
        $day = rand(1, 28);
        $hour = rand(0, 23);
        $minute = rand(0, 59);
        $second = rand(0, 59);
        
        return Carbon::create($year,$month ,$day , $hour, $minute, $second);
    }
}
