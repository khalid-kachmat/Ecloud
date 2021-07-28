<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     *
     */
    public function login(Request $request, User $user): Response|Application|ResponseFactory
    {
        $data = json_decode($request->getContent(), true);



        // Check email
        $user = $user->all()->where('email', $data['email'])->first();

        // Check password
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'failed'
            ], 401);
        }

        $token = $user->createToken('mapped')->plainTextToken;

        $response = [
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
