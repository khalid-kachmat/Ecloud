<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(Request $request, User $user)
    {
        $data = json_decode($request->getContent(), true);

        if (!Auth::attempt($request->only('email', 'password'))){
            echo 'invalid email or password';
        }else{
            echo 'yes';
        }
//        echo $request->getContent();
    }
}
