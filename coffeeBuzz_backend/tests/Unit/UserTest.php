<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
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
            'username' => "Sue",
            'role_id' => 3,
            'email' => 'Sue@gmail.com',
            'password' => Hash::make("secret"),
            'remember_token' => Str::random(10),
        ]);

        factory(User::class)->create([
            'id' => 2,
            'username' => "Susan",
            'role_id' => 3,
            'email' => 'Susan@gmail.com',
            'password' => Hash::make("secret"),
            'remember_token' => Str::random(10),
        ]);

        $users = User::users();
        $this->assertCount(2, $users);
//        dd($users->toArray());
        $this->assertEquals([
            [
                "id" => 1,
                "username" => "Sue",
                "email" => "Sue@gmail.com",
                "role_id" => 3,
            ],
            [
                "id" => 2,
                "username" => "Susan",
                "email" => "Susan@gmail.com",
                "role_id" => 3,
            ],
        ], $users->toArray());
    }
}
