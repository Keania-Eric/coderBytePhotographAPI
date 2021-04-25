<?php
namespace App\Actions\Auth;

use App\Models\User;
use App\Contracts\Auth\ILogsInUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class LogsInUser implements ILogsInUser
{
        
    /**
     * Logs in a n identified user
     *
     * @param array $data [To be logged in user data ]
     *
     * @return array
     */
    public function loginUser(array $data):array
    {
        $user = User::firstWhere('email', $data['email']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $tokenString = $user->createToken('Authorization')->plainTextToken;

        return ['token'=>$tokenString, 'user'=>$user];
    }
}