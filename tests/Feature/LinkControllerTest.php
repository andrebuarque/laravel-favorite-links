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
		$links = factory($this->link, 2)->create();
		foreach ($links as $link) {
			$link->tags()->attach(factory('App\Tag')->create()->id);
		}
		
		$this->actingAs($this->user)
			 ->get(self::URL_BASE)
			 ->assertStatus(Response::HTTP_OK)
			 ->assertJson($links->toArray());
	}
	
	public function testCreate() {
		$link = factory($this->link)->make([
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			'id' => 1
		]);
		$tags = factory('App\Tag', 2)->create();
		
		$link->tags = $tags;
		
		$tags = array_map(function ($tag) { return $tag['id']; }, $link->tags->toArray());
		
		$data = $link->toArray();
		$data['tags'] = $tags;
		
		$this->actingAs($this->user)
			 ->post(self::URL_BASE, $data)
			 ->assertStatus(Response::HTTP_CREATED)
			 ->assertJson($link->toArray());
	}
	
}
