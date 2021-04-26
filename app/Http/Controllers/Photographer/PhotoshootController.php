<?php

namespace App\Http\Controllers\Photographer;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Contracts\Photoshoot\IUploadsPhotoshoot;

class PhotoshootController extends Controller
{
    use ApiResponder;
    
    /**
     * Method upload
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, IUploadsPhotoshoot $action)
    {
        try {

            $request->validate([
                'uploads'=> 'required|image',
                'request_id'=> 'required'
            ]);

            DB::beginTransaction();

                $data = $action->uploadShoots($request);

                $data['status']= 1;

                $data['message'] = 'Shoots has been uploaded';

            DB::commit();

            return $this->successResponse($data);

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->errors());
            if ($e instanceof ValidationException) {
                return $this->errorMessage($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
            
            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
