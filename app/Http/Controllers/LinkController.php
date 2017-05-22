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
            
            return Link::listAllByUser($this->getUser());
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
            $data['user_id'] = $this->getUser()->id;
            
            $link = Link::store($data);
            
            $linkResult = Link::findOneByUser($this->getUser(), $link->id);
            
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
            
            $link = Link::findOneByUser($this->getUser(), $id);
            
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
            $data['user_id'] = $this->getUser()->id;
            
            $link = Link::findOneByUser($this->getUser(), $id);
            
            if (isset($link)) {
                Link::doUpdate($link, $data);
                return Link::findOneByUser($this->getUser(), $link->id);
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
            
            $link = Link::findOneByUser($this->getUser(), $id);
            
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

    private function getUser()
    {
        return Auth::user();
    }
}
