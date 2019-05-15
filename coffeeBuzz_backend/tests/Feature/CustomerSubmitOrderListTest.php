<?php

namespace Tests\Feature;

use App\Drink;
use App\DrinkName;
use App\DrinkSize;
use App\Food;
use App\OrderedItem;
use App\OrderList;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerSubmitOrderListTest extends TestCase
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

        // Sue Login
        $sue_login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'sue',
                'password' => 'secret',
            ]
        );
        $sue_login->assertStatus(200);

        // Sue gets her own identity
        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $sue_login->json("access_token")])
        );
        $response->assertStatus(200);

        $sue_id = $response->json('id');

        // Sue select a menu and create an item to be added to the order list
        $response = $this->call('POST', 'api/items',
            [
                'item_type' => 'food',
                'food_id' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $sue_login->json("access_token")])
        );

        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $item_id = $response->data->id;

        // Customer input the item that has been created and input its identity to the order list
        $response = $this->call('POST', 'api/order_lists',
            [
                'id' => 1,
                'user_id' => $sue_id,
                'item_id' => $item_id,
                'qty' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $sue_login->json("access_token")])
        );
        $response->assertStatus(200);

        // Sue select another menu and create an item to be added to the order list
        $response = $this->call('POST', 'api/items',
            [
                'item_type' => 'drink',
                'drink_id' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $sue_login->json("access_token")])
        );
        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $item_id = $response->data->id;

        // Customer input the item that has been created and input its identity to the order list
        $response = $this->call('POST', 'api/order_lists',
            [
                'id' => 1,
                'user_id' => $sue_id,
                'item_id' => $item_id,
                'qty' => 1,
            ],
            $this->transformHeadersToServerVars([ 'Authorization' => $sue_login->json("access_token")])
        );
        $response->assertStatus(200);

        // Customer submit all data to the OrderedListItems
        $data = $this->call('GET', 'api/order_lists/'.$sue_id.'/get',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $order_list_items = json_decode($data->getContent());

        $order_list = OrderList::orderLists();
        $this->assertCount(2, $order_list);

        // move the user items in cart to the ordered list and remove the cart from user
        foreach ($order_list_items as $order_list_item){
            $inputed_item = $this->call('POST', 'api/ordered_items',
                [
                    'user_id' => $order_list_item->user_id,
                    'item_id' => $order_list_item->item_id,
                    'qty' => $order_list_item->qty,
                ],
                $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
            );
            $inputed_item->assertStatus(200);

            $deleted_item = $this->call('DELETE', 'api/order_lists/'.$order_list_item->id);
            $deleted_item->assertStatus(200);
        }

        $order_list = OrderList::orderLists();
        $this->assertCount(0, $order_list);


        $ordered_item = OrderedItem::orderedItems();
        $this->assertCount(2, $ordered_item);

    }
}
