<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|\App\Http\Controllers\NULL
     */
    public function index()
    {
        return $this->getUser();
    }
    
    /**
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|NULL
     */
    private function getUser()
    {
        return Auth::user();
    }
}
