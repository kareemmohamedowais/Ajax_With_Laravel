<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\governorate;
use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index(){

        $users  = User::paginate(3);
        return view('users.index',compact('users'));
    }

    public function create(){
        $govs = governorate::all();
        $cities = city::all();
        return view('users.create',compact('govs','cities'));
    }
    public function edit($id){
        $user = User::findOrFail($id);
        $govs = governorate::all();
        $cities = city::all();
        return view('users.edit',compact('user','govs','cities'));
    }

    public function update(Request $request){
        $user = User::findOrFail($request->id);
        $user->update($request->except(['id','_token']));
        return response()->json([
            'status'=>200,
            'msg'=>'user updated successfully',
        ]);
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
    public function searchAjax(Request $request){
        $users = User::where('name','LIKE','%'.$request->searchAjaxValue.'%')
        ->orWhere('email','LIKE','%'.$request->searchAjaxValue.'%')
        ->orWhere(function($query)use($request){
            $query->whereRelation('governorate','name','LIKE','%'.$request->searchAjaxValue.'%');
            $query->orWhereRelation('city','name','LIKE','%'.$request->searchAjaxValue.'%');
        })
        ->get();

        return view('users.ajax_search',['users'=>$users]);

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

    public function delete(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->delete();
        return response()->json([
            'ststus'=>true,
            'msg'=>'user deleted successfully',
            // 'user_id'=>$request->user_id,
        ]);
    }


}
