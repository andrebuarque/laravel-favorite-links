<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function testHomeWithoutSession()
    {
        $response = $this->get('/home');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /**
     *
     * @return void
     */
    public function testHomeWithSession()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user)
            ->get('/home')
            ->assertStatus(Response::HTTP_OK);
    }
}
