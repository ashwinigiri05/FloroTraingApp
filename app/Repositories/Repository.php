<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Auth;
use App\Repositories\Request;
use App\User;
use Carbon\Carbon;
use App\Models\UserActivity;

class Repository
{
    protected $model;

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
    public function edit_user($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function getUser($id)
    { 
        $user = User::find($id);
        return $user;
       
    }

    public function update($id, $attributes)
    { 
        $user = User::find($id);
        return $user->update($attributes);
    }
        
    public function authProfile()
    {
         $user = User::find(Auth::user()->id);
         return $user;
    }

    public function user($userName)
    {    
            $users = \DB::table('users')->where('username','like','%'.$userName.'%')
            ->orWhere('firstname','like','%'.$userName.'%')
            ->orWhere('lastname','like','%'.$userName.'%')
            ->orWhere('email','like','%'.$userName.'%')->paginate(10);

            return  $users;
        
    }

    public function insertMultipleRows(array $records)
    {
        return $this->model->insert($records);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }
}
