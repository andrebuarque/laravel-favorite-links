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
    	
    	factory($this->tag)->create($data);
    	
    	$response = $this->actingAs($this->user)
    					 ->get(self::URL_BASE . "/1");
    	
    	$response->assertStatus(Response::HTTP_OK)
    			 ->assertJson(['data' => $data]);
    }
    
    public function testCreate()
    {
    	$params = ['title' => 'php'];
    	
    	$response = $this->actingAs($this->user)
    					 ->post(self::URL_BASE, $params);
    	
    	$response->assertStatus(Response::HTTP_CREATED)
    			 ->assertJson($params);
    }
    
    public function testUpdate() 
    {
    	factory($this->tag)->create();
    	
    	$params = ['title' => 'php1'];
    	
    	$response = $this->actingAs($this->user)
    					 ->put(self::URL_BASE . "/1", $params);
    	
    	$response->assertStatus(Response::HTTP_OK)
    			 ->assertJson($params);
    }
    
    public function testDelete()
    {
    	factory($this->tag, 2)->create();
    	
    	// delete
    	$response = $this->actingAs($this->user)
    					 ->delete(self::URL_BASE . "/1");
    	
		$response->assertStatus(Response::HTTP_OK);

		// list all
		$response = $this->actingAs($this->user)
						 ->get(self::URL_BASE);
		
		$response->assertStatus(Response::HTTP_OK);
		$this->assertEquals(count($response->json()), 1);
    }
}
