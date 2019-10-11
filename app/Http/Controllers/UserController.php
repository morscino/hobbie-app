<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        //Validate User Input
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_num'=> 'required|integer|unique:users',
	        'password' => 'required|string|min:6',
             ]
        );

        if( $validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_num' => $request->phone_num
            ]
        ); 
        
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }


    public function login(Request $request){
        $credentilals = $request->all();

        //$token = auth()->attempt($credentilals);
        try{
            if( !$token = auth()->attempt($credentilals)){
                return response()->json(['error'=>'invalid_credentials'],400);
            }
        }catch(JWTException $e){
            return response()->json(['error'=>'could_not_create_token'],500);
        }

        return response()->json(compact('token'),201);
    }

    //  public function authUser(){
    //     try {
    //         $user = auth()->userOrFail();
    //     } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
    //         return response()->json(['error'=> $e->getMessage()],500); 
    //     }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    //         return response()->json(['error'=> $e->getMessage()],500); 
    //     }catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['error'=> $e->getMessage()],500); 
    //     }
    
    //     //return response()->json([compact('user')],201);  
    //     return $user;      
    // }

   

    public function logout(){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
