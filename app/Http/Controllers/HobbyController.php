<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;
use App\Hobby;




class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $details = $request->all();
        $user = $this->authUser();
        //return  $user;

        if(!$newHobby =  $user->hobbies()->create($details)){
            return response()->json(['error'=>'Could not create hobby'],500);
        }
        //Send mail to user
        $message = "You have just created hobby ".$request->name;
        Mail::to($user->email)->send(new SendMailable($message));
        return response()->json(['hobby'=>$newHobby],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $user = $this->authUser();

        $hobbies = $user->hobbies;
       

       return response()->json(['hobbies'=> $hobbies],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $user = $this->authUser();
        $newDetails = $request->only(['name','category']);
       

        $updatedHobby = $user->hobbies()->whereId($id)->update($newDetails);
        return Hobby::findOrFail($id);
    }

    // public function authUser(){
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
        $user = $this->authUser();

        $hobby = Hobby::findOrFail($id);
        $hobby->delete();

         //Send mail to user
        $message = "You have just deleted hobby ".$hobby->name;
        Mail::to($user->email)->send(new SendMailable($message));
        
        return response()->json(['hobby'=> $hobby],201);
    }
}
