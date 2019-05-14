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

        $response->assertStatus(422);
    }
}
