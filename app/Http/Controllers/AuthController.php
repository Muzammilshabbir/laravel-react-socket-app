<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\ServerCreated;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules =  [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }
        //Check Email
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            $response = [
                'message' => 'Invalid Credentials',
            ];
            return response($response, 422);
        }
        $token = $user->createToken('TodoManager-Api')->plainTextToken;

        $response = [
            'token' => $token,
            'type' => 'bearer',
            'user' => $user,
        ];

        return response($response, 200);
    }

    public function register(Request $request)
    {

        $rules =  [
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('TodoManager-Api')->plainTextToken;


        $response = [
            'token'=>$token,
            'type' => 'bearer',
            'user' => $user,
        ];

        event(new ServerCreated($user));

        return response($response, 201);
    }

    public function user(){

        return response()->json(['users' => User::all()],200);
    }
}
