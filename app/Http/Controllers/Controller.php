<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseError(\Exception $e, Response $response)
    {
        $response->setContent([
            'error' => $e->getMessage()
        ]);
        $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        
        return $response;
    }
}
