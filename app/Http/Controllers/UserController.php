<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    protected $user;
    public function store(Request $request)
    {
      
        $request->validate([
            'nom' => 'required|string|regex:/^[a-zA-Z]+$/|max:255',
            'prenom' => 'required|string|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'required|string|unique:users|email|max:255',
            'user_type' => 'required|string|regex:/^[a-zA-Z]+$/|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]);
        if($user){
            return ["result"=>"user created"];
        }else 
            return ["result"=>"user not created"];
    }
    
    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ]; 
             return response($response, 201);
    }
    function logout()
    {
        response(201);
    }
    function index()
    {
         return view('Acc');
    }
}
