<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class LinkController extends Controller
{
	private $user;
	
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = Auth::user();
	}
	
    /**
     * Get links of the User
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        	
        	return Link::listAllByUser($this->user);
        	
        } catch (Exception $e) {
        	return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	try {
    			
    		$data = $request->only('title', 'url', 'tags');
    		$data['user_id'] = $this->user->id;
    		
    		$link = Link::create($data);
    		
    		$link->tags()->attach($data['tags']);
    		
    		return response()->json(Link::findOneByUser($this->user, $link->id), Response::HTTP_CREATED);
    			
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO
    }
}
