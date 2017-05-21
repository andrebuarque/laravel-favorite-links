<?php
namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all tags by User
     *
     * @param Response $response            
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Response $response)
    {
        try {
            
            return Tag::listAllByUser($this->getUser());
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Get one tag of the User
     * 
     * @param int $id            
     * @param Response $response            
     * @return Response
     */
    public function show(int $id, Response $response)
    {
        try {
            
            $tag = Tag::findOneByUser($this->getUser(), $id);
            
            if (isset($tag))
                return $tag;
            
            return $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Store a Tag
     * 
     * @param Response $response            
     * @param Request $request            
     * @return Tag
     */
    public function store(Response $response, Request $request)
    {
        try {
            
            $data = $request->only('title');
            $data['user_id'] = $this->getUser()->id;
            
            $tag = Tag::create($data);
            
            return response()->json($tag, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Update a Tag
     * 
     * @param int $id            
     * @param Response $response            
     * @param Request $request            
     * @return Response
     */
    public function update(int $id, Response $response, Request $request)
    {
        try {
            
            $data = [
                'title' => $request->get('title')
            ];
            
            $tag = Tag::findOneByUser($this->getUser(), $id);
            
            if (isset($tag)) {
                $tag->update($data);
                return $tag;
            }
            
            return $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->responseError($e, $response);
        }
    }

    /**
     * Delete a Tag of the User
     * 
     * @param int $id            
     * @param Response $response            
     * @return Response
     * @internal param Request $request
     */
    public function destroy(int $id, Response $response)
    {
        try {
            
            $tag = Tag::findOneByUser($this->getUser(), $id);
            
            if (isset($tag)) {
                $tag->delete();
                return $tag;
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
