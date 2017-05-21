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
     * @param Response $response            
     * @return \Illuminate\Database\Eloquent\Collection|\App\static[]|unknown
     */
    public function index(Response $response)
    {
        try {
            
            return Link::listAllByUser($this->user);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request            
     * @param Response $response            
     * @return unknown|\Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        try {
            
            $data = $request->only('title', 'url', 'tags');
            $data['user_id'] = $this->user->id;
            
            $link = Link::store($data);
            
            $linkResult = Link::findOneByUser($this->user, $link->id);
            
            return response()->json($linkResult, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, Response $response)
    {
        try {
            
            $link = Link::findOneByUser($this->user, $id);
            
            if (isset($link))
                return $link;
            
            return $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Response $response)
    {
        try {
            
            $data = $request->only('title', 'url', 'tags');
            
            $link = Link::findOneByUser($this->user, $id);
            
            if (isset($link)) {
                $link->update($data);
                $link->tags()->sync($data['tags']);
                return $link;
            }
            
            return $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Response $response)
    {
        try {
            
            $link = Link::findOneByUser($this->user, $id);
            
            if (isset($link)) {
                $link->tags()->detach();
                $link->delete();
                return $link;
            }
            
            return $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }
}
