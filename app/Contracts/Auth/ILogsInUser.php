<?php
namespace App\Contracts\Auth;


interface ILogsInUser 
{
    
    /**
     * Logs in  a user
     *
     * @param array $data [To be logged in user data]
     *
     * @return array
     */
    public function loginUser(array $data):array;
}