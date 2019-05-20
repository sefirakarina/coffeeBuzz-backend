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

class RemoveStaffTest extends TestCase
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
            'id' => 2,
            'role' => 'barista'
        ]);

        factory(Role::class)->create([
            'id' => 1,
            'role' => 'manager'
        ]);

        factory(User::class)->create([
            'username' => 'Someone3',
            'email' => 'someone3@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('secret'),
        ]);
        factory(User::class)->create([
            'username' => 'Someone',
            'email' => 'someone@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        //the manager login
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        //manager delete the staff
        $response = $this->call('DELETE', 'api/users/'.$response->json("id"),
            [
                'id' => 1,
            ]
        );
        $response->assertStatus(200);

        //deleted staff tries to login
        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone3',
                'password' => Hash::make('secret'),
            ]
        );
        $response->assertStatus(401);

    }
}
