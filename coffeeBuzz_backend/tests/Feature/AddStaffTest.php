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

class AddStaffTest extends TestCase
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
            'username' => 'manager',
            'email' => 'someone2@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        $response = $this->call('POST', 'api/auth/login',
            [
                'username' => 'manager',
                'password' => 'secret',
            ]
        );
        $response->assertStatus(200);

        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars([ 'Authorization' => $response->json("access_token")])
        );
        $response->assertStatus(200);

        $response = $this->call('POST', 'api/users',
            [
                'username' => 'staff',
                'email' => 'someone@gmail.com',
                'role' => 2,
                'password' => Hash::make('secret'),
            ]
        );
        $response->assertStatus(200);

//        $response = $this->call('PUT', 'api/users/'.$response->json("id"),
//            [
//                'username' => $response->json('EditedStaffName'),
//                'email' => $response->json('email@email.com'),
//                'role' => $response->json(2),
//                'password' => Hash::make('secret'),
//            ]
//        );
//        $response->assertStatus(200);
//
//        $response = $this->call('PUT', 'api/users/'.$response->json("id"),
//            [
//                'username' => $response->json(''),
//                'email' => $response->json('email@email.com'),
//                'role' => $response->json(2),
//                'password' => Hash::make('secret'),
//            ]
//        );
//        $response->assertStatus(404);
    }
}
