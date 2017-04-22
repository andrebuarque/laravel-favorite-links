<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
    	return Tag::findByUser(Auth::user());
    }
}
