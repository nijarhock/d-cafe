<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\User;
use App\Logs;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == "admin") 
        {
            $user = User::all();
        }
        else
        {
            $user = User::where("id", Auth::id())->get();
        }
        return view('users.index', ["jquery" => "users.jquery", 'user' => $user]);
    }

    public function create()
    {
        return view('users.create', ["jquery" => "users.jquery"]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password'))
        ]);

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah User ".$request->get('name') ." | ". $request->get('email') ." | ". $request->get('role');
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $user = user::find($request->id);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255',
                        Rule::unique('users')->ignore($request->id)
                    ],
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $user = user::find($request->id);
        $user->name = $request->name;
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah User ".$request->id." | ".$request->get('name') ." | ". $request->get('email') ." | ". $request->get('role');
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $user = user::find($request->id);

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus User ".$request->id." | ".$user->name ." | ". $user->email ." | ". $user->role;
        $logs->save();

        $user->delete();

        return response()->json("OK", 200);
    }
}
