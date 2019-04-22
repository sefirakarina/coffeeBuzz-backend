<?php

use Illuminate\Database\Seeder;

class DrinkSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drink_sizes')->insert([
            'id' => 1,
            'size' => 'Small',
        ]);
        DB::table('drink_sizes')->insert([
            'id' => 2,
            'size' => 'Medium',
        ]);
        DB::table('drink_sizes')->insert([
            'id' => 3,
            'size' => 'Large',
        ]);
    }
}
