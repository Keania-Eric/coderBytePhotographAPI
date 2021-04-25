<?php
namespace App\Contracts\Auth;


interface IRegistersUser 
{

    
    /**
     * Registers a new User
     * 
     * @param array $data [ Registration data ]
     * 
     * @return array
     */
    public function registerUser(array $data):array;
}