<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $users = User::sortable()->paginate(10);
        return view('home',['users' => $users]);
        
    }

}
