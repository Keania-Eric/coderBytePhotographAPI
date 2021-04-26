<?php
namespace App\Contracts\Photoshoot;

use App\Models\User;
use App\Models\Photoshoot;

interface IApprovesPhotoshoot
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
    public function approveShoots(Photoshoot $shoot, User $user):array;
}