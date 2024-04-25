<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Tambahkan baris ini
use Illuminate\Support\Facades\Mail;
use App\Mail\TokenMail;



class AuthController extends Controller
{
   
    public function register(Request $request)
    {

        $datauser = new User(); 
        $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
        
        $datauser->name = $validatedData['name'];
        $datauser->email = $validatedData['email'];
        $datauser->password = bcrypt($validatedData['password']);
        $datauser->save();
        

            return response()->json([
                'message' => 'Pengguna berhasil didaftarkan',
                'user' => $datauser
            ], 201);
    }

    public function login(Request $request)
    {

    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8'
    ]);

    $user = User::where('email', $validated['email'])->first();

    if (!$user || !Hash::check($validated['password'], $user->password)) {
        return response()->json([
            'message' => 'Kredensial tidak valid'
        ], 401);
    }

    $token = $user->createToken('api-produk')->plainTextToken;

    // Kirim token ke email pengguna
    Mail::to($user->email)->send(new TokenMail($token));

    return response()->json([
        'message' => 'Login berhasil',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ], 200);

    }

    

}
