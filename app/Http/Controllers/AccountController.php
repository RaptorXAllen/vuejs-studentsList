<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function login(Request $request)
    {                
        if(User::where('email',$request->email)->where('password',$request->password)->count() == 1)
            return true;
        else
            return false;
    }
}
