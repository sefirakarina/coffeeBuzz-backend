<?php

namespace Tests\Unit;

use App\Food;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(Food::class)->create([
            'name' =>  'Burritos',
            'qty' =>  5,
            'price' => 5,
        ]);

        $foods = Food::foods();
        $this->assertCount(1, $foods);

        $this->assertEquals([
            "id" => $foods[0]['id'],
            'name' =>  'Burritos',
            'qty' =>  5,
            'price' => 5,
        ], $foods->toArray()[0]);
    }
}
