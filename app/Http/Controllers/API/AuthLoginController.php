<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts\Auth\ILogsInUser;
use App\Contracts\Auth\ILogsOutUser;
use App\Http\Controllers\Controller;

class AuthLoginController extends Controller
{
    //

    use ApiResponder;

    
    /**
     * Method login
     *
     * @param Request $request [explicite description]
     * @param ILogsInUser $action [explicite description]
     *
     * @return void
     */
    public function login(Request $request, ILogsInUser $action)
    {
        try {

            $loginData = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $data = $action->loginUser($loginData);

            $data['status'] = 1;

            $data['message'] = 'Login was successful';

            return $this->successResponse($data);
            
        }catch(\Exception $e) {
            
            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    /**
     * Method logout
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function logout(Request $request, ILogsOutUser $action)
    {
        try {
           
            $action->logoutUser($request->user());

            $data = ['status'=>1 , 'message'=> 'User has been logged out'];

            return $this->successResponse($data);

        }catch(\Exception $e) {

            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
