<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
	private $user;

    public function __construct() 
    {
    	$this->middleware('auth');
    	$this->user = Auth::user();
    }
    
    /**
     * Get all tags by User
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public function index(Response $response)
    {
    	try {
    		
    		return Tag::listAllByUser($this->user);
    		
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    /**
     * Get one tag of the User
     * @param unknown $id
     * @param Response $response
     * @param Request $request
     * @return Tag
     */
    public function show($id, Response $response, Request $request)
    {
    	try {
    		
    		$tag = Tag::findOneByUser($this->user, $id);
    		
    		if (isset($tag))
    			return $tag;
    		
    		return $response->setStatusCode(Response::HTTP_NOT_FOUND);
    		
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    /**
     * Store a Tag
     * @param Response $response
     * @param Request $request
     * @return Tag
     */
    public function store(Response $response, Request $request)
    {
    	try {
    		
    		$data = $request->only('title');
    		$data['user_id'] = $this->user->id;
    		 
    		$tag = Tag::create($data);
    		
    		return response()->json($tag, Response::HTTP_CREATED);
    		
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    /**
     * Update a Tag
     * @param unknown $id
     * @param Response $response
     * @param Request $request
     * @return unknown
     */
    public function update($id, Response $response, Request $request) 
    {
    	try {
    		
    		$data = $request->only('title');
    	
    		$tag = Tag::findOneByUser($this->user, $id);
    		
    		if (isset($tag)) {
    			$tag->update($data);
    			return $tag;
    		}
    		
    		return $response->setStatusCode(Response::HTTP_NOT_FOUND);
    	
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    /**
     * Delete a Tag of the User
     * @param unknown $id
     * @param Response $response
     * @param Request $request
     * @return unknown
     */
    public function destroy($id, Response $response, Request $request)
    {
    	try {
    	
    		$tag = Tag::findOneByUser($this->user, $id);
    		
    		if (isset($tag)) {
    			$tag->delete();
    			return $tag;
    		}
    	
    		return $response->setStatusCode(Response::HTTP_NOT_FOUND);
    		 
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
}
