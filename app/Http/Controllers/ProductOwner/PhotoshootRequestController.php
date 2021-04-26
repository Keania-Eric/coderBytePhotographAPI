<?php

namespace App\Http\Controllers\ProductOwner;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Contracts\PhotoshootRequest\ICreatesPhotoshootRequest;

class PhotoshootRequestController extends Controller
{
    use ApiResponder;
    
    /**
     * Method store
     *
     * @param Request $request [explicite description]
     * @param ICreatesPhotoshootRequest $action [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, ICreatesPhotoshootRequest $action)
    {
        try {

            $validData = $request->validate([
                'photographer_id'=> 'required',
            ]);

            $validData['requester_id'] = $request->user()->id;

            $photoRequest = $action->createRequest($validData);

            $dataResponse = [
                'status'=> 1,
                'message'=> 'Request has been created ',
                'data'=> $photoRequest
            ];

            return $this->successResponse($dataResponse);

        }catch (\Exception $e) {
            
            if ($e instanceof ValidationException) {
                return $this->errorMessage($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
            
            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
