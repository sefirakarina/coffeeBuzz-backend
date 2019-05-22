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

class ManageDrinkTest extends TestCase
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
            'role' => 'admin'
        ]);

        factory(DrinkSize::class)->create([
            'id' => 1,
            'size' => 's',
        ]);

        factory(DrinkSize::class)->create([
            'id' => 2,
            'size' => 'm',
        ]);

        factory(DrinkSize::class)->create([
            'id' => 3,
            'size' => 'l',
        ]);


        factory(DrinkName::class)->create([
            'id' => 1,
            'name' => 'cappucino',
        ]);

        factory(DrinkName::class)->create([
            'id' => 2,
            'name' => 'coffee',
        ]);

        // initial drink in database
        factory(Drink::class)->create([
            'id' => 1,
            'name_id' => 1,
            'size_id' => 1,
            'price' => 5,
        ]);

        // admin account
        factory(User::class)->create([
            'username' => 'Admin',
            'email' => 'someone@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        // admin login
        $admin_login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Admin',
                'password' => 'secret',
            ]
        );
        $admin_login->assertStatus(200);

        $drinks = Drink::drinks();

        // admin do not create new size since there are only S, M, L sizes

        // admin do not create new drink type

        // admin only update drink prize
        $response = $this->call('PUT', 'api/drinks/' . $drinks[0]['id'],
            [
                'price' => 8,
                'sizeId' => 1,
                'nameId' => 1
            ]
        );
        $response->assertStatus(200);

        // get updated drink to compare the expected value
        $updated_drink = $this->call('GET', 'api/drinks/' . $drinks[0]['id'],
            $this->transformHeadersToServerVars(['Authorization' => $admin_login->json("access_token")]));
        $expected = json_decode($updated_drink->getContent());

        // expected value comparison
        $this->assertEquals([
            "id" => $drinks[0]['id'],
            "name_id" => 1,
            "size_id" => 1,
            "price" => 8,
        ], (array)$expected->data);
    }
}
