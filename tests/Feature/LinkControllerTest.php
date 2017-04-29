<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkControllerTest extends TestCase
{
	use DatabaseMigrations;
	
	protected $user;
	const URL_BASE = '/links';
	protected $tag = 'App\Link';
	
	protected function setUp()
	{
		parent::setUp();
		$this->user = factory('App\User')->create();
	}

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$this->assertTrue(true);
	}
}
