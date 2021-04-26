<?php

namespace App\Http\Controllers\Photographer;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoshootRequestController extends Controller
{
    //
    use ApiResponder;
    
    /**
     * Method available
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function available(Request $request)
    {
        $user = $request->user();
        $pendingRequests = $user->pendingPhotographRequest();

        return $this->successResponse($data = ['data'=> $pendingRequests]);
    }
}
