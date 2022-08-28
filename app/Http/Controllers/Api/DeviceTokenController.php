<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'device' => 'required',
            'type' => 'nullable',
        ]);


        $user = Auth::guard('sunctam')->user();

        $user->deviceTokens()->create($request->all());
    }
}
