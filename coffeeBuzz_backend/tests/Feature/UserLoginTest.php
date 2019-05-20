<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
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
            'username' => 'Someone',
            'email' => 'someone@gmail.com',
            'role_id' => 3,
            'password' => Hash::make('secret'),
        ]);

        factory(Role::class)->create([
            'id' => 1,
            'role' => 'manager'
        ]);

        factory(User::class)->create([
            'username' => 'Someone2',
            'email' => 'someone2@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        factory(Role::class)->create([
            'id' => 2,
            'role' => 'barista'
        ]);

        factory(User::class)->create([
            'username' => 'Someone3',
            'email' => 'someone3@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('secret'),
        ]);

        //customer login test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => Hash::make('wrongpassword'),
            ]
        );
        $response->assertStatus(401);

        //manager login test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone2',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);


        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone2',
                'password' => Hash::make('wrongpassword'),
            ]
        );
        $response->assertStatus(401);

        //barista login test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone3',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

//        $array = json_decode($response->getContent());
//        var_dump($array->access_token);

        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone3',
                'password' => Hash::make('wrongpassword'),
            ]
        );
        $response->assertStatus(401);

        //no username and pasword filled
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => '',
                'password' => Hash::make(''),
            ]
        );
        $response->assertStatus(401);
    }
}
