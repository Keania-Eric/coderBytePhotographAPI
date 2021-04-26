<?php
namespace App\Actions\Photoshoot;

use App\Models\User;
use App\Models\Photoshoot;
use App\Contracts\Photoshoot\IApprovesPhotoshoot;


class ApprovesPhotoshoot implements IApprovesPhotoshoot
{

     /**
     * Approve shoots
     *
     * @param Photoshoot $shoot [explicite description]
     * 
     * @param User $user [explicite description]
     *
     * @return array
     */
    public function approveShoots(Photoshoot $shoot, User $user):array
    {
        // update shoot status to approve
       $shoot->update(['status'=> 1]);

       $media = $shoot->getFirstMedia('shoots');
       
       if ($media) {
           
           //move shoot to user downloads folder
            $path = $media->getPath();

            $user->addMedia($path)->preservingOriginal() 
                    ->toMediaCollection('downloads');
       }
       

        return ['media'=> $media];
    }
}