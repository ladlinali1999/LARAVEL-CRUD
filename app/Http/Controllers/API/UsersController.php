<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Userss = Users::all();
      return response()->json($Userss);
    }
  
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(Request $request)
    {
      $request->validate([
        'name' => '',
        'mobile' => '',
        'email' => '',
        'password' => ''
      ]);
  
      $newUsers = new Users([
        'name' => $request->get('name'),
        'mobile' => $request->get('mobile'),
        'email' => $request->get('email'),
        'password' => $request->get('password')
      ]);
  
      $newUsers->save();
  
      return response()->json($newUsers);
    }
  
    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $Users = Users::findOrFail($id);
      return response()->json($Users);
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
      $Users = Users::findOrFail($id);
  
      $request->validate([
        'name' => 'required|max:255',
        'mobile' => 'required',
        'email' => 'required',
        'password' => 'required'
      ]);
  
      $Users->name = $request->get('name');
      $Users->mobile = $request->get('mobile');
      $Users->email = $request->get('email');
      $Users->password = $request->get('password');
      
  
      $Users->save();
  
      return response()->json($Users);
    }
  
    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $Users = Users::findOrFail($id);
      $Users->delete();
  
      return response()->json($Users::all());
    }
}
