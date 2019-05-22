<?php

namespace Tests\Feature;

use App\Food;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodListTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(Role::class)->create([
            'id' => 1,
            'role' => 'manager'
        ]);

        factory(User::class)->create([
            'username' => 'Someone',
            'email' => 'someone@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        factory(Food::class)->create([
            'name' => 'Burritos',
            'qty' => 5,
            'price' => 5,
        ]);

        $response = $this->call('GET', 'api/auth/foods');

        $response->assertStatus(200);

        factory(Role::class)->create([
            'id' => 3,
            'role' => 'customer'
        ]);

        factory(User::class)->create([
            'username' => 'SomeoneManager',
            'email' => 'someoneManager@gmail.com',
            'role_id' => 3,
            'password' => Hash::make('secret'),
        ]);

        $response = $this->call('GET', 'api/auth/foods',
            $this->transformHeadersToServerVars(['Authorization' => $response->json("access_token")])
        );
        $response->assertStatus(200);

        //the manager login
        $login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'secret',
            ]
        );
        $login->assertStatus(200);

        // initial food
        $response = $this->call('POST', 'api/foods',
            [
                'name' => "bread",
                'qty' => 5,
                'price' => 7,
            ]
        );
        $response->assertStatus(200);
        $second_item_id = json_decode($response->getContent())->data->id;

        // manager update the food
        $response = $this->call('PATCH', 'api/foods/' . $second_item_id,
            [
                'id' => $second_item_id,
                'name' => 'pizza',
                'qty' => 5,
                'price' => 3,
            ], $this->transformHeadersToServerVars(['Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        // get the updated value
        $response = $this->call('GET', 'api/foods/' . $second_item_id,
            $this->transformHeadersToServerVars(['Authorization' => $login->json("access_token")]));

        $expected = json_decode($response->getContent());

        // expected update value
        $this->assertEquals(
            [
                'id' => $second_item_id,
                'name' => 'pizza',
                'qty' => 5,
                'price' => 3
            ]
            , (array)$expected->data);

        // delete one of the food
        $response = $this->call('DELETE', 'api/foods/' . $second_item_id,
            $this->transformHeadersToServerVars(['Authorization' => $response->json("access_token")])
        );
        $food = Food::foods();
        $this->assertCount(1, $food);
        $response->assertStatus(200);
    }
}
