<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use App\User;

class HomeControllerTest extends TestCase
{
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
    	$user = User::find(1);
    	
    	$response = $this->actingAs($user)->get('/home');
    	
    	$response->assertStatus(Response::HTTP_OK);
    }
}
