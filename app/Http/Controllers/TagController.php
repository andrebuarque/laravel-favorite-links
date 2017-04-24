<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct() 
    {
    	$this->middleware('auth');
    }
    
    /**
     * Get all tags by User
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\static[]
     */
    public function index(Response $response)
    {
    	try {
    		
    		return Tag::findByUser(Auth::user());
    		
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    public function show($tag, Response $response, Request $request)
    {
    	// TODO
    }
    
    public function store(Response $response, Request $request)
    {
    	try {
    		
    		$data = $request->only('title');
    		$data['user_id'] = Auth::user()->getAuthIdentifier();
    		 
    		$tag = Tag::create($data);
    		
    		return response()->json($tag, Response::HTTP_CREATED);
    		
    	} catch (Exception $e) {
    		return $response->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    }
    
    public function update($tag, Response $response, Request $request) 
    {
    	// TODO
    }
    
    public function destroy($tag, Response $response, Request $request)
    {
    	// TODO
    }
}
