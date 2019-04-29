<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;
use App\Services\UserService;

class UserController extends Controller
{   private $userService;
    public $successStatus = 200;

    public function __construct(UserService $userService)
    {
     
        $this->userService = $userService;
    }
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
          
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

   
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

    public function store(Request $request)
    {
                    
        $validatedData = $request->validate([
        'username'=>'required|string|min:3|max:255',
        'firstname'=>'required|string|min:3|max:255',
        'lastname'=>'required|string|min:3|max:255',
        'email'=>'required|email',
        'password' => 'min:6|required_with:confmpassword|same:confmpassword',
        'confmpassword' => 'required',
        'address'=>'required|min:3|max:2000',
        'house_number'=>'required|numeric|min:2',
        'postal_code'=>'required|numeric|min:4',
        'city'=>'string|required',
        ]);
        $users=$this->userService->store($request->all());
        return response()->json($users);
        
    }
    
    
     public function update(Request $request, $id)
     {
         
      $validatedData = $request->validate([
        'username'=>'required|string|min:3|max:255',
        'firstname'=>'required|string|min:3|max:255',
        'lastname'=>'required|string|min:3|max:255',
        'email'=>'required|email',
        'password' => 'min:6|required_with:confmpassword|same:confmpassword',
        'confmpassword' => 'required',
        'address'=>'required|min:3|max:2000',
        'house_number'=>'required|numeric|min:2',
        'contact_number'=>'required|numeric|min:10',
        'postal_code'=>'required|numeric|min:4',
        'city'=>'string|required',
     ]);
     $this->userService->update($request->all(), $id);

     return response()->json($validatedData);
      
     
     }

     public function destroy($id)
     {
         $result = $this->userService->deleteUser($id);
         return response()->json($result);
        
     }

    public function search(Request $request)
    {
      $serach = $request->get('search');
      $users = $this->userService->searchUser($serach);
      return response()->json($users);
    }
    
}