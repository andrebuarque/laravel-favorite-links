<?php

namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
	use DatabaseMigrations;
	
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListAll()
    {
    	$sizeTags = 10;
    	$user = factory('App\User')->create();
    	$tags = factory('App\Tag', $sizeTags)->create();
    	
    	$response = $this->actingAs($user)
    					 ->get('/tags');
    	
    	$response
    		->assertStatus(Response::HTTP_OK)
    		->assertJson($tags->toArray());
    }
}
