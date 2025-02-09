<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(){

        $users  = User::all();
        return view('users.index',compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        return $request;
    }



}
