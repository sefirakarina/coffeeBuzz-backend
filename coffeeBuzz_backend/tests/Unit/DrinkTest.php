<?php

namespace Tests\Unit;

use App\Drink;
use App\DrinkName;
use App\DrinkSize;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DrinkTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(DrinkName::class)->create([
            'id' =>  1,
            'name' =>  'cappucino',
        ]);

        factory(DrinkSize::class)->create([
            'id' => 1,
            'size' => 's',
        ]);

        factory(Drink::class)->create([
            'id' => 1,
            'name_id' => 1,
            'size_id' => 1,
            'price' => 5,
        ]);

        $drinks = Drink::drinks();
        $this->assertCount(1, $drinks);
    }
}
