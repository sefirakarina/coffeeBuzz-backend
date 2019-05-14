<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResetPasswordTest extends TestCase
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

        $response->assertStatus(200);

        $response = $this->call('PUT', 'api/users/'.$response->json("id"),
        [
            'username' => $response->json('username'),
            'email' => $response->json('email'),
            'role' => $response->json('role_id'),
            'password' => 'aa',
        ]
        );

        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/logout',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'Someone',
                'password' => 'aa',
            ]
        );

        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/logout',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );

        $response->assertStatus(200);

        $response = $this->call('PUT', 'api/users/'.$response->json("id"),
            [
                'username' => $response->json('username'),
                'email' => $response->json('email'),
                'role' => $response->json('role_id'),
                'password' => 'aa',
            ]
        );

        $response->assertStatus(405);
    }
}
