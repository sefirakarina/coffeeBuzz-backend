<?php

namespace Tests\Feature;

use App\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = factory(Role::class)->create([
            'id' => 3,
            'role' => 'customer'
        ]);

        $this->assertEquals(
            [
                "id" => 3,
                "role" => "customer",
            ]
        , $response->toArray());
    }
}
