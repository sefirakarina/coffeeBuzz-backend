<?php

namespace Tests\Feature;

use App\Drink;
use App\DrinkName;
use App\DrinkSize;
use App\Food;
use App\Item;
use App\OrderList;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class CartAndOrderListTest extends TestCase
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
            'id' => 3,
            'role' => 'customer'
        ]);

        factory(User::class)->create([
            'id' => 1,
            'username' => "sue",
            'role_id' => 3,
            'email' => 'Sue@gmail.com',
            'password' => Hash::make("secret"),
            'remember_token' => Str::random(10),
        ]);

        factory(User::class)->create([
            'id' => 2,
            'username' => "susan",
            'role_id' => 3,
            'email' => 'Susan@gmail.com',
            'password' => Hash::make("secret"),
            'remember_token' => Str::random(10),
        ]);

        factory(DrinkName::class)->create([
            'id' =>  1,
            'name' =>  'cappucino',
        ]);

        factory(DrinkName::class)->create([
            'id' =>  2,
            'name' =>  'coffee',
        ]);

        factory(DrinkSize::class)->create([
            'id' => 1,
            'size' => 's',
        ]);

        factory(DrinkSize::class)->create([
            'id' => 2,
            'size' => 'm',
        ]);

        factory(Drink::class)->create([
            'id' => 1,
            'name_id' => 1,
            'size_id' => 1,
            'price' => 5,
        ]);

        factory(Drink::class)->create([
            'id' => 2,
            'name_id' => 1,
            'size_id' => 2,
            'price' => 8,
        ]);

        factory(Drink::class)->create([
            'id' => 3,
            'name_id' => 2,
            'size_id' => 1,
            'price' => 5,
        ]);

        factory(Food::class)->create(
            [
                'id' =>1,
                'name' =>  'Burritos',
                'qty' =>  5,
                'price' => 5,
            ],
            [
                'id' =>2,
                'name' =>  'Sandwich',
                'qty' =>  7,
                'price' => 5,
            ]
        );

        // Customer Login
        $login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'sue',
                'password' => 'secret',
            ]
        );
        $login->assertStatus(200);

        // Customer select a menu and create an item to be added to the order list
        $response = $this->call('POST', 'api/items',
            [
                'item_type' => 'food',
                'food_id' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $item_id = $response->data->id;

        // Customer gets its own identity
        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        $user_id = $response->json('id');

        // Customer input the item that has been created and input its identity to the order list
        $response = $this->call('POST', 'api/order_lists',
        [
            'user_id' => $user_id,
            'item_id' => $item_id,
            'qty' => 1,
        ],
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );
        $response->assertStatus(200);

        // Customer select another menu and create an item
        $response = $this->call('POST', 'api/items',
            [
                'item_type' => 'drink',
                'drink_id' => 2
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $item_id = $response->data->id;

        // Customer gets its own identity again
        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        $user_id = $response->json('id');

        // Customer input the item that has been created and input its identity to the order list
        $response = $this->call('POST', 'api/order_lists',
            [
                'id' => 2,
                'user_id' => $user_id,
                'item_id' => $item_id,
                'qty' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );
        $response->assertStatus(200);
        $second_item_id = json_decode($response->getContent())->data->id;

        $items = Item::items();
        $this->assertCount(2, $items);

        $order_list = OrderList::orderLists();
        $this->assertCount(2, $order_list);

        // get all the user items in cart to RE-check the customer's item in the cart
        $response = $this->call('GET', 'api/order_lists/'.$user_id.'/get',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );
        $response->assertStatus(200);


        // delete one of the item from user cart
        $response = $this->call('DELETE', 'api/order_lists/'.$second_item_id,
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $order_list = OrderList::orderLists();
        $this->assertCount(1, $order_list);
        $response->assertStatus(200);

        // customer logged out
        $response = $this->call('POST', 'api/auth/logout',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $response->assertStatus(200);

        // Other customer logged in
        $login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'susan',
                'password' => 'secret',
            ]
        );
        $login->assertStatus(200);

        // Customer gets its own identity again
        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $login->json("access_token")])
        );
        $response->assertStatus(200);

        $user_id = $response->json('id');

        // get all the user items in cart, since there is no item selected by this user the total item should be 0
        $response = $this->call('GET', 'api/order_lists/'.$user_id.'/get',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $this->assertEquals([], $response->json());

    }
}
