<?php
namespace App\Actions\Photoshoot;

use App\Models\Photoshoot;
use Illuminate\Http\Request;
use App\Models\PhotoshootRequest;
use App\Contracts\Photoshoot\IUploadsPhotoshoot;


class UploadsPhotoshoot implements IUploadsPhotoshoot
{
    

    /**
     * Takes in a request and uploads the shoots
     *
     * @param \Illuminate\Http\Request $request [request sent by the user]
     *
     * @return array
     */
    public function uploadShoots(Request $request):array
    {
        $photoRequest = PhotoshootRequest::find($request->request_id);

        if (! $photoRequest) {
            throw new \InvalidArgumentExeption('Cannot find photoshoot requests for this shoots');
        }

        $photoshoot = Photoshoot::create([
            'requester_id'=> $photoRequest->requester_id,
            'photographer_id'=> $photoRequest->photographer_id,
            'request_id'=> $photoRequest->id
        ]);

        $photoshoot->addMediaFromRequest('uploads')->toMediaCollection('shoots');

        $photoRequest->update(['status'=>2]); // change status to shoot

        return ['photoshoot'=> $photoshoot];
    }


       
}