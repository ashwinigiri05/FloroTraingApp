<?php

namespace App\Repositories;

use App\User;
use App\Models\UserActivity;

class UserRepository extends Repository
{
    
    public function __construct(User $model)
    {
        $this->model = $model;
       
    }

    public function getModelClass() : string
    {
        return User::class;
    }

   
}
