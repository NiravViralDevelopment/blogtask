<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    public function login(request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $response = [
                'status' => 1,
                'message'   => 'User login successfully.',
                'token'     => $user->createToken('MyApp')->plainTextToken
            ];
            return ApiResponse($response);
        }
        else{
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }
    }

    public function get_users(request $request){
        try
        {
            DB::beginTransaction();
            $data = Auth::user();
            $result = paginate($data,($request->page ?? null));
            return ApiResponse($result);
        }catch (\Exception $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }catch (\Throwable $e){
            $error_msg =  error_msg();
            return ApiResponse($error_msg);
        }
    }
}
