<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Contracts\Auth\IRegistersUser;
use Illuminate\Validation\ValidationException;

class AuthRegisterController extends Controller
{
    
    use ApiResponder;

    /**
     * Method register
     *
     * @param \Illuminate\Http\Request $request [Incoming request]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request, IRegistersUser $action)
    {

        try {
            
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'name' => 'required',
                'role'=> 'numeric'
            ]);

            DB::beginTransaction();
            
               $data = $action->registerUser($validatedData);

               // maintain the requuest was successful
               $data['status'] = 1;

               $data['message']  = 'User has been created';

            DB::commit();

            return $this->successResponse($data);

        }catch(\Exception $e) {

            DB::rollback();

            if ($e instanceof ValidationException) {
                return $this->errorMessage($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
            
            return $this->errorMessage($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
