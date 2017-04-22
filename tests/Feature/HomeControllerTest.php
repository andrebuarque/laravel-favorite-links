<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
	use DatabaseMigrations;
	
    /**
     * @return void
     */
    public function testHomeWithoutSession()
    {
    	$response = $this->get('/home');
        $response->assertStatus(Response::HTTP_FOUND);
    }
    
    /**
     * @return void
     */
    public function testHomeWithSession()
    {
    	$user = factory('App\User')->create();
    	
    	$response = $this->actingAs($user)->get('/home');
    	
    	$response->assertStatus(Response::HTTP_OK);
    }
}
