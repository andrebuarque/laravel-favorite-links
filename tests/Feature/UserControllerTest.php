<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Http\Response;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
    }

    public function testUsernameOfLoggedUser()
    {
        $this->actingAs($this->user)
            ->get('/logged-user')
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($this->user->name);
    }
}
