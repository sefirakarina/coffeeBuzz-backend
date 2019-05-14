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

class UserRegisterTest extends TestCase
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

        //customer logout test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'secret',
            ]
        );
        //dd($response->access_token);
        $response->assertStatus(200);

        $array = json_decode($response->getContent());

        $response = $this->call('POST', 'api/auth/logout',
            [
                'token' => $array->access_token,
            ]
        );
        $response->assertStatus(200);

        //manager logout test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone2',
                'password' => 'secret',
            ]
        );

        $response->assertStatus(200);

        $array = json_decode($response->getContent());

        $response = $this->call('POST', 'api/auth/logout',
            [
                'token' => $array->access_token,
            ]
        );
        $response->assertStatus(200);

        //barista logout test
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone3',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

        $array = json_decode($response->getContent());

        $response = $this->call('POST', 'api/auth/logout',
            [
                'token' => $array->access_token,
            ]
        );
        $response->assertStatus(200);

    }
}
