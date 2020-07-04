<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logs;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $logs = new Logs;
            $logs->user_id = Auth::id();
            $logs->desc = "User ".Auth::user()->name." Login";
            $logs->save();

            return redirect()->intended('dashboard');
        }
        else
        {
            return redirect()->route('login')->with('error', 'Email or password invalid, contact administrator');
        }
    }

    /**
     * login api jwt
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Login API";
        $logs->save();

        return response()->json(compact('token'));
    }
}
