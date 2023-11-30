<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /*
	 * Register new user
	*/
    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';

        if (User::create($validatedData)) {
            return response()->json(null, 201);
        }

        return response()->json(null, 404);
    }

    /*
	 * Generate sanctum token on successful login
	*/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where(['email' => $request->email, 'role' => 'user'])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken($request->email)->plainTextToken
        ], 200);
    }


    /*
	 * Revoke token; only remove token that is used to perform logout (i.e. will not revoke all tokens)
	*/
    public function logout(Request $request)
    {

        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();
        //$request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)
        return response()->json(null, 200);
    }


    /*
	 * Get authenticated user details
	*/
    public function getAuthenticatedUser(Request $request)
    {
        return auth()->user();
    }

    public function updateAuthenticatedUser(Request $request)
    {
        if($request->get('password')){
            $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);    
        }else{
            $request->validate([
                'name'=>'required',
                'nickname'=>'required',
                'phone'=>'required',
                'email' => 'required|email',
            ]);
        }

        $user = auth()->user();
        $updated = User::find($user->id)->update($request->all());
        if($updated){
            return response()->json(null, 200);
        }
        return response()->json(null, 401);
    }


    public function sendPasswordResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->only('email'));
        if ($user->get()) {
            $reset_token = rand(100000, 999999);
            $user->update(['password_reset' => $reset_token]);
            //sendmail


        }

        return response()->json(null, 200);
    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $password = Hash::make($validatedData['password']);

        $user = User::where('token', $request->only('password_reset'));
        if ($user->get()) {
            $user->update(['password' => $password, 'password_reset' => null]);
            //sendmail


        }
    }
}
