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
	
	protected $user;
	const URL_BASE = '/tags';
	protected $tag = 'App\Tag';
	
	protected function setUp()
	{
		parent::setUp();
		$this->user = factory('App\User')->create(); 
	}
	
    public function testListAll()
    {
    	$sizeTags = 10;
    	$tags = factory($this->tag, $sizeTags)->create();
    	
    	$response = $this->actingAs($this->user)
    					 ->get(self::URL_BASE);
    	
    	$response->assertStatus(Response::HTTP_OK)
    			 ->assertJson($tags->toArray());
    }
    
    public function testFindOne()
    {
    	$data = [
    		'title' => 'tag test'
    	];
    	
    	$tag = factory($this->tag)->create($data);
    	
    	$response = $this->actingAs($this->user)
    					 ->get(self::URL_BASE . "/" . $tag->id);
    	
    	$response->assertStatus(Response::HTTP_OK)
    			 ->assertJson($tag->toArray());
    }
    
    public function testCreate()
    {
    	$tag = factory($this->tag)->make();
    	
    	$response = $this->actingAs($this->user)
    					 ->post(self::URL_BASE, $tag->toArray());
    	
    	$response->assertStatus(Response::HTTP_CREATED)
    			 ->assertJson($tag->toArray());
    }
    
    public function testUpdate() 
    {
    	$tag = factory($this->tag)->create();
    	$tag->title = 'php1';
    	
    	$response = $this->actingAs($this->user)
    					 ->put(self::URL_BASE . "/" . $tag->id, $tag->toArray());
    	
    	$response->assertStatus(Response::HTTP_OK)
    			 ->assertJson($tag->toArray());
    }
    
    public function testDelete()
    {
    	$tags = factory($this->tag, 2)->create();
    	
    	// delete
    	$response = $this->actingAs($this->user)
    					 ->delete(self::URL_BASE . "/" . $tags[0]->id);
    	
		$response->assertStatus(Response::HTTP_OK)
				 ->assertJson($tags[0]->toArray());
    }
}
