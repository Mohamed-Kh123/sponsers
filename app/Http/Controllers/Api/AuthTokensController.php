<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
            'abilities' => 'nullable',
        ]);

        $user = User::where('email', '=', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return Response::json([
                'message' => 'Invalid username or password'
            ], 401);
        }

        $abilities = $request->input('abilities', ['*']);

        if($abilities && is_string($abilities)){
            $abilities = explode(',', $abilities);
        }

        $token = $user->createToken($request->device_name, $abilities);

        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 201);
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        // delete all the tokens
        // $user->tokens()->delete();


        // delete current access token
        $user->currentAccessToken()->delete();

        return Response::json([
            'message' => 'Current access token deleted!'
        ], 200);

    }
}
