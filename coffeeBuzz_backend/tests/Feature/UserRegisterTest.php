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
        /*factory(Role::class)->create([
            'id' => 3,
            'role' => 'customer'
        ]);

        try {
            factory(User::class)->create([
                'username' => "Someone",
                'role_id' => 3,
                'email' => 'Someone@gmail.com',
                'password' => Hash::make("secret"),
                'remember_token' => Str::random(10),
            ]);

            factory(User::class)->create([
                'username' => "Sue",
                'role_id' => 1,
                'email' => 'Sue@gmail.com',
                'password' => Hash::make("secret"),
                'remember_token' => Str::random(10),
            ]);

            $response = true;
        } catch (\Exception $e) {
            // testing should go in here since there are
            // username or email duplication
            $response = false;
        }

        // make sure only one registered since it has same identity
        // username and email
        $users = User::users();
        $this->assertCount(1, $users);

        // true if the response is false
        $this->assertFalse($response);*/


        factory(Role::class)->create([
            'id' => 3,
            'role' => 'customer'
        ]);

        $response = $this->call('POST', 'api/users',
            [
                'username' => 'Someone',
                'email' => 'someone@gmail.com',
                'role' => 3,
                'password' => Hash::make('secret'),
            ]
        );

        $response->assertStatus(200);

        $response = $this->call('POST', 'api/users',
            [
                'username' => 'Someone',
                'email' => 'someone@gmail.com',
                'role' => 3,
                'password' => Hash::make('secret'),
            ]
        );

//        dd($response);
        $response->assertStatus(422);
    }
}
