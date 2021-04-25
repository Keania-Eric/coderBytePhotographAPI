<?php
namespace App\Actions\Auth;

use App\Models\User;
use App\Contracts\Auth\ILogsOutUser;


class LogsOutUser implements ILogsOutUser
{
    
    /**
     * Method logoutUser
     *
     * @param User $user [explicite description]
     */
    public function logoutUser(User $user)
    {
        return $user->tokens()->delete();
    }
}