<?php

use Illuminate\Database\Seeder;

class DrinkNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drink_names')->insert([
            'id' => 1,
            'name' => 'Espresso',
        ]);
        DB::table('drink_names')->insert([
            'id' => 2,
            'name' => 'Double Espresso',
        ]);
        DB::table('drink_names')->insert([
            'id' => 3,
            'name' => 'Latte',
        ]);
        DB::table('drink_names')->insert([
            'id' => 4,
            'name' => 'Cappuccino',
        ]);
        DB::table('drink_names')->insert([
            'id' => 5,
            'name' => 'Long Black',
        ]);
        DB::table('drink_names')->insert([
            'id' => 6,
            'name' => 'Hot Chocolate',
        ]);
        DB::table('drink_names')->insert([
            'id' => 7,
            'name' => 'Earl Grey',
        ]);
        DB::table('drink_names')->insert([
            'id' => 8,
            'name' => 'Assam',
        ]);
        DB::table('drink_names')->insert([
            'id' => 9,
            'name' => 'Green Tea',
        ]);
        DB::table('drink_names')->insert([
            'id' => 10,
            'name' => 'Mint Tea',
        ]);
        DB::table('drink_names')->insert([
            'id' => 11,
            'name' => 'Hot Coffee',
        ]);
    }
}
