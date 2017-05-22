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
    
    private function getTagStructure()
    {
        return [
            'id',
            'title',
            'created_at',
            'updated_at'
        ];
    }

    public function testListAll()
    {
        $tags = factory($this->tag, 10)->create();
        
        $this->actingAs($this->user)
            ->get(self::URL_BASE)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($tags->toArray());
    }

    public function testFindOne()
    {
        $tag = factory($this->tag)->create();
        
        $this->actingAs($this->user)
            ->get(self::URL_BASE . "/" . $tag->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($tag->toArray());
    }

    public function testFindOne404()
    {
        $this->actingAs($this->user)
            ->get(self::URL_BASE . "/1")
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testCreate()
    {
        $tag = factory($this->tag)->make();
        
        $this->actingAs($this->user)
            ->post(self::URL_BASE, $tag->toArray())
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($tag->toArray());
    }

    public function testUpdate()
    {
        $tag = factory($this->tag)->create();
        $tag->title = 'php1';
        
        $this->actingAs($this->user)
            ->put(self::URL_BASE . "/" . $tag->id, $tag->toArray())
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure($this->getTagStructure());
    }

    public function testUpdate404()
    {
        $tag = factory($this->tag)->create();
        $tag->title = 'php1';
        
        $this->actingAs($this->user)
            ->put(self::URL_BASE . "/123", $tag->toArray())
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testDelete()
    {
        $tags = factory($this->tag, 2)->create();
        
        $this->actingAs($this->user)
            ->delete(self::URL_BASE . "/" . $tags[0]->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($tags[0]->toArray());
    }

    public function testDelete404()
    {
        $this->actingAs($this->user)
            ->delete(self::URL_BASE . "/1")
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
