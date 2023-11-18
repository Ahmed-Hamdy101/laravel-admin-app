<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(Request $r)
    {
        $user = User::create([
            "f_name"=> $r->input('f_name'),
            "l_name"=>  $r->input('l_name'),
            "email"=>  $r->input('email'),
            "password"=> bcrypt( $r->input('password')),
        ]);       
        return response($user , 201);
    }
    // update the information
    public function update()
    {
       
    }
    // delete the information
    public function delete()
    {
       
    }
}