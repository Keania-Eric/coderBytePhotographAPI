<?php

namespace App\Http\Controllers\ProductOwner;

use App\Models\Photoshoot;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Contracts\Photoshoot\IApprovesPhotoshoot;

class PhotoshootController extends Controller
{
    //
    use ApiResponder;
    
    /**
     * Approve a photo shoot
     *
     * @param Request $request [explicite description]
     * @param IApprovesPhotoshoot $action [explicite description]
     *
     * @return void
     */
    public function approve(Request $request, IApprovesPhotoshoot $action)
    {
        try {

            $request->validate(['shoot_id'=> 'required']);

            DB::beginTransaction();

                $shoot = Photoshoot::findorfail($request->shoot_id);

                $data = $action->approveShoots($shoot, $request->user());
                
                $pathToFile = $data['media']->getPath();
                
            DB::commit();
            
            return response()->download($pathToFile);

        }catch (\Exception $e) {

            DB::rollback();

            if ($e instanceof ValidationException) {
                return $this->errorMessage($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
            
            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    
    /**
     * View Sample 
     *
     * @param Request $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sample(Request $request)
    {
        $photoshoot = Photoshoot::findOrFail($request->shoot_id);

        $mediaThumb = $photoshoot->getFirstMedia('shoots');
        if ($mediaThumb) {
            $url = $mediaThumb->getUrl('thumbnails');
            return response()->json(['status'=>1, 'preview'=>$url]);
        }

        return response()->json(['status'=>1, 'message'=> 'No preview available']);

        
    }
}
