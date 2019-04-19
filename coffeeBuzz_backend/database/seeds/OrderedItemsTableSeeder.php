<?php

use Illuminate\Database\Seeder;

class OrderedItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OrderedItem::class, 20)->create();
    }
}
