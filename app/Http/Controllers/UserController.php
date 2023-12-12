<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Response as HttpResponse;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    // get single id
    public function show($id)
    {
      return  User::find($id); 
    }
    // store the information
    public function store(UserCreateRequest $r)
    {
        $user = User::create($r->only('f_name','l_name','email') +[ "password"=> bcrypt( $r->input('password'))]);       
        return response($user , HttpResponse::HTTP_CREATED);
    }
    // update the information
    public function update(UserUpdateRequest $r, $id)
    {
       $userup = User::find($id);
       $userup->update($r->only('f_name','l_name','email'));
       return response($userup,HttpResponse::HTTP_ACCEPTED);
    }
    // delete the information
    public function destroy( $id)
    {
        try {
            // Find the user by ID and delete
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., user not found)
            return response()->json(['error' => 'User not found'], 404);
        }
}
}