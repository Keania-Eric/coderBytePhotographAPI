<?php
namespace App\Actions\Auth;

use App\Models\User;
use App\Contracts\Auth\IRegistersUser;


class RegistersUsers implements IRegistersUser
{
        
    /**
     * Method register
     *
     * @param array $data [ Registration data ]
     *
     * @return array
     */
    public function registerUser(array $data):array
    {
        $data['password'] = bcrypt($data['password']);
        
        $user = User::create($data);

        $tokenString = $user->createToken('Authorization')->plainTextToken;

        return ['token'=>$tokenString, 'user'=>$user];
    }
}