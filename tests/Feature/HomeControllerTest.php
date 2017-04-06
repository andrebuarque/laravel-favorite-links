<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

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
}
