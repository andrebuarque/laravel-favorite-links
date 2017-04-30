<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Http\Response;
use Carbon\Carbon;

class LinkControllerTest extends TestCase
{
	use DatabaseMigrations;
	
	protected $user;
	const URL_BASE = '/links';
	protected $link = 'App\Link';
	
	protected function setUp()
	{
		parent::setUp();
		$this->user = factory('App\User')->create();
	}

	public function testListAll()
	{
		$links = factory($this->link, 2)
					->create()
					->map(function($link){
						$link->tags()->attach(factory('App\Tag')->create()->id);
						return $link;
					});
		
		$this->actingAs($this->user)
			 ->get(self::URL_BASE)
			 ->assertStatus(Response::HTTP_OK)
			 ->assertJson($links->toArray());
	}
	
	public function testCreate() 
	{
		$link = factory($this->link)->make([
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'id' => 1
		]);
		
		$link->tags = factory('App\Tag', 2)->create();
		
		$data = $link->toArray();
		$data['tags'] = $link->tags->map(function($tag) { return $tag->id; })->toArray();
		
		$assertJSON = $link->toArray();
		$assertJSON['tags'] = $link->tags->toArray();
		
		$this->actingAs($this->user)
			 ->post(self::URL_BASE, $data)
			 ->assertStatus(Response::HTTP_CREATED)
			 ->assertJson($assertJSON);
	}
	
	public function testFindOne() 
	{
		$link = factory($this->link)->create();
		$tags = factory('App\Tag', 2)->create();
		$idTags = $tags->map(function($tag) { return $tag->id; })->toArray();
		$link->tags()->attach($idTags);
		
		$assertJSON = $link->toArray();
		$assertJSON['tags'] = $tags->toArray();
		
		$this->actingAs($this->user)
			 ->get(self::URL_BASE . '/' . $link->id)
			 ->assertStatus(Response::HTTP_OK)
			 ->assertJson($assertJSON);
	}
	
	public function testFindOne404() 
	{
		$this->actingAs($this->user)
			 ->get(self::URL_BASE . '/1')
			 ->assertStatus(Response::HTTP_NOT_FOUND);
	}
	
	public function testUpdate() 
	{
		$link = factory($this->link)->create();
		$tags = factory('App\Tag', 2)->create();
		$idTags = $tags->map(function($tag) { return $tag->id; })->toArray();
		$link->tags()->attach($idTags);
		
		$link->title = 'other title';
		$link->url = 'http://www.otherlink.com';
		
		$data = $link->toArray();
		$data['tags'] = $idTags;
	
		$assertJSON = $link->toArray();
		$assertJSON['tags'] = $tags->toArray();
	
		$this->actingAs($this->user)
			 ->put(self::URL_BASE . '/' . $link->id, $data)
			 ->assertStatus(Response::HTTP_OK)
			 ->assertJson($assertJSON);
	}
	
	public function testUpdate404() 
	{
		$link = factory($this->link)->create();
		$tags = factory('App\Tag', 2)->create();
		$idTags = $tags->map(function($tag) { return $tag->id; })->toArray();
		$link->tags()->attach($idTags);
		
		$link->title = 'other title';
		$link->url = 'http://www.otherlink.com';
		
		$data = $link->toArray();
		$data['tags'] = $idTags;
		
		$this->actingAs($this->user)
			 ->put(self::URL_BASE . '/30', $data)
			 ->assertStatus(Response::HTTP_NOT_FOUND);
	}
	
	public function testDelete()
	{
		$link = factory($this->link)->create();
		$tags = factory('App\Tag', 2)->create();
		$link->tags()->attach($tags->map(function($tag) { return $tag->id; })->toArray());
		
		$assertJSON = $link->toArray();
		$assertJSON['tags'] = $tags->toArray();
		
		$this->actingAs($this->user)
			 ->delete(self::URL_BASE . '/' . $link->id)
			 ->assertStatus(Response::HTTP_OK)
			 ->assertJson($assertJSON);
	}
	
	public function testDelete404()
	{
		$this->actingAs($this->user)
			 ->delete(self::URL_BASE . '/30')
			 ->assertStatus(Response::HTTP_NOT_FOUND);
	}
}
