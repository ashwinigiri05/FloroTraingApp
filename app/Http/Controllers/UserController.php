<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;


class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    private $userService;

    /**
     * UserController constructor.
     * Initialize all class instances.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
     
        $this->userService = $userService;
    }

    public function create()
    {
        return  view('user.create');
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
     $this->userService->store($request->all());
     return redirect('/home');
        
    }
    public function edit($id)
    {
      $user = $this->userService->getUser($id);
       return view('user.edit', ['user' => $user]);
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

     return redirect('/home');
      
     
    }

    public function destroy($id)
    {
        $result = $this->userService->deleteUser($id);
        return redirect('/home');
    }

    public function myprofile()
    {
       $user = $this->userService->getProfile();
       return view('user.myprofile',compact('user'));
    }

    public function search(Request $request)
    {
      $serach = $request->get('search');
      $users = $this->userService->searchUser($serach);
      return view('/home',[ 'users' =>$users]);
      
     
    }
}
