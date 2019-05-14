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

        factory(Food::class)->create([
            'name' =>  'Burritos',
            'qty' =>  5,
            'price' => 5,
        ]);

        $response = $this->call('GET', 'api/auth/foods');

        $response->assertStatus(200);

        factory(Role::class)->create([
            'id' => 3,
            'role' => 'customer'
        ]);

        factory(User::class)->create([
            'username' => 'Someone',
            'email' => 'someone@gmail.com',
            'role_id' => 3,
            'password' => Hash::make('secret'),
        ]);

        $response = $this->call('GET', 'api/auth/foods',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $response->assertStatus(200);
    }
}
