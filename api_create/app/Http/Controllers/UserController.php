<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'nickname' => 'required|min:3|max:15|exists:people',
            'password' => 'required|min:8|max:16|'
        ]);

        $user = People::where('nickname', $request->nickname)->first();

        if ( $user->password == md5($request->password)) {
            $token = $user->createToken('my-app-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }
        else{
            return response()->json("Girdiğiniz şifre yanlış");
        }
    }
}
