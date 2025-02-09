<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\governorate;
use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(){

        $users  = User::all();
        return view('users.index',compact('users'));
    }

    public function create(){
        $govs = governorate::all();
        $cities = city::all();
        return view('users.create',compact('govs','cities'));
    }

    public function store(Request $request){


        $request->validate($this->filterUser());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'gov_id' => $request->gov_id,
            'city_id' => $request->city_id,
        ]);
        if($user){
            return response()->json([
                'status' => 200,
                'msg'=>'user created successfully'
            ]);
        }
    }

    private function filterUser(){
        return [
            'name'=>['required'],
            'email'=>['required','unique:users,email'],
            'password'=>['required'],
            'gov_id'=>['exists:governorates,id'],
            'city_id'=>['exists:cities,id'],
        ];
    }

    public function getCities(Request $request){

        $cities = city::where('gov_id',$request->governorate_id)->get(['id', 'name']);
        return response()->json($cities);


    }


}
