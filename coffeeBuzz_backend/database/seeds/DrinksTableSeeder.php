<?php

use Illuminate\Database\Seeder;

class DrinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            'id' => 1,
            'name_id' => 1,
            'size_id' => 1,
            'price' => 3
        ]);
        DB::table('drinks')->insert([
            'id' => 2,
            'name_id' => 2,
            'size_id' => 1,
            'price' => 3,
        ]);
        DB::table('drinks')->insert([
            'id' => 3,
            'name_id' => 3,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 4,
            'name_id' => 4,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 5,
            'name_id' => 4,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 6,
            'name_id' => 5,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 7,
            'name_id' => 5,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 8,
            'name_id' => 6,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 9,
            'name_id' => 6,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 10,
            'name_id' => 7,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 11,
            'name_id' => 7,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 12,
            'name_id' => 8,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 13,
            'name_id' => 8,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 14,
            'name_id' => 9,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 15,
            'name_id' => 9,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 16,
            'name_id' => 10,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 17,
            'name_id' => 10,
            'size_id' => 3,
            'price' => 7,
        ]);
        DB::table('drinks')->insert([
            'id' => 18,
            'name_id' => 11,
            'size_id' => 1,
            'price' => 3,
        ]);
        DB::table('drinks')->insert([
            'id' => 19,
            'name_id' => 11,
            'size_id' => 2,
            'price' => 5,
        ]);
        DB::table('drinks')->insert([
            'id' => 20,
            'name_id' => 11,
            'size_id' => 3,
            'price' => 7,
        ]);

    }
}
