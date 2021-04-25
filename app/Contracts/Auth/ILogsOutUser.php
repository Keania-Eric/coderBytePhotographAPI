<?php
namespace App\Contracts\Auth;

use App\Models\User;


interface ILogsOutUser 
{
    
    /**
     * LogoutUser
     *
     * @param User $user [explicite description]
     *
     */
    public function logoutUser(User $user);
}