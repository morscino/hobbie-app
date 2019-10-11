<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function authUser(){
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error'=> $e->getMessage()],500); 
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error'=> $e->getMessage()],500); 
        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error'=> $e->getMessage()],500); 
        }
    
        //return response()->json([compact('user')],201);  
        return $user;      
    }

    public function refreshToken(){
        try {
            $newToken = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error'=> $e->getMessage()],500); 
        }

        return response()->json(['token'=>$newToken],201);
    }

}


