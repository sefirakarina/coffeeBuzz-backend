<?php

namespace Tests\Feature;

use App\Drink;
use App\DrinkName;
use App\DrinkSize;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DrinkListTest extends TestCase
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

        $response = $this->call('GET', 'api/auth/drinks');

        $response->assertStatus(200);

        factory(User::class)->create([
            'username' => 'Someone',
            'email' => 'someone@gmail.com',
            'role_id' => 3,
            'password' => Hash::make('secret'),
        ]);

        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

        $response = $this->call('GET', 'api/auth/drinks',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $response->assertStatus(200);
    }
}
