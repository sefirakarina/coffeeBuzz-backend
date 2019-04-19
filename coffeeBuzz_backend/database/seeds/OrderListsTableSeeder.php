<?php

use Illuminate\Database\Seeder;

class OrderListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OrderList::class, 20)->create();
    }
}
