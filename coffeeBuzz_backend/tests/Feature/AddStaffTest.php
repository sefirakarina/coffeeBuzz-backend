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

        $login = $this->call('POST', 'api/auth/login',
            [
                'username' => 'manager',
                'password' => 'secret',
            ]
        );
        $login->assertStatus(200);

        $response = $this->call('POST', 'api/auth/me',
            $this->transformHeadersToServerVars(['Authorization' => $login->json("access_token")])
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

        $update = $this->call('PATCH', 'api/admin',
            [
                'id' => json_decode($response->getContent())->data->id,
                'username' => 'somestaff',
                'email' => 'somestaff@gmail.com',
            ]);
        $update->assertStatus(200);

        // get updated drink to compare the expected value
        $updated_staff = $this->call('GET', 'api/users/' . json_decode($response->getContent())->data->id,
            $this->transformHeadersToServerVars(['Authorization' => $login->json("access_token")]));
        $expected = json_decode($updated_staff->getContent());

        // expected value comparison
        $this->assertEquals([
            "id" => json_decode($response->getContent())->data->id,
            "username" => 'somestaff',
            "role_id" => 2,
            "email" => 'somestaff@gmail.com',
        ], (array)$expected->data);

        // delete the staff while the admin remain
        $response = $this->call('DELETE', 'api/users/' . json_decode($response->getContent())->data->id,
            $this->transformHeadersToServerVars(['Authorization' => $login->json("access_token")])
        );
        $user = User::users();
        $this->assertCount(1, $user);
        $response->assertStatus(200);
    }
}
