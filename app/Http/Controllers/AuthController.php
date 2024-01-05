<?php

namespace App\Http\Controllers;

use App\Events\UserDataEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('tokenForAuthentication')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function index()
    {
        $cashedData = Redis::get('userData');

        if (isset($cashedData)) {
            event(new UserDataEvent($cashedData));
            return $cashedData;
        } else {
            $user = User::all();
            Redis::set('userData', $user);
            event(new UserDataEvent($user->toArray()));
            return response()->json($user);
        }
    }
}
