<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Tag;
use Illuminate\Http\Response;

class TagControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListAll()
    {
    	$response = $this->actingAs(User::find(1))
    					 ->get('/tags');
    	
    	$response->assertStatus(Response::HTTP_OK);
    }
}
