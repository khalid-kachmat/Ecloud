<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function login(Request $request, User $user)
    {
        $data = json_decode($request->getContent(), true);
        $result = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
//        if (Auth::attempt($result)){
//            echo 'yes';
//        }else{
//            echo 'noop';
//        }
        echo $result;
    }
}
