<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    
    public function login()
    {
        if (Auth::check())
        {return redirect('home');}
        else
        return view('login');
    }
    public function authlogin(Request $request)
    {
        $validator = $request -> validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($validator)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('loginError','Login failed! Username or Password is invalid');

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        // if (! $token = auth()->attempt($validator->validated())) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        // return $this->createNewToken($token);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/login');
    }

    }

    // public function userProfile() {
    //     return response()->json(auth()->user());
    // }

    // public function me()
    // {
    //     $me = auth()->user();
    //     return new JsonResponse(['result' => $me]);
    // }

    // public function logout()
    // {
    //     auth()->logout();
    //     return response()->json(['message' => 'User sukses logout dari aplikasi']);
    // }

    // // public function refresh() {
    // //     return $this->createNewToken(auth()->refresh());
    // // }

    // protected function createNewToken($token){
    //     return response()->json([
    //         'token' => $token,
    //         'user' => auth()->user()
    //     ]);
    // }


    // public function test()
    // {
    //     $data = User::all();
    //     return new JsonResponse($data);
    // }

    // public function new_reg(Request $request)
    // {
    //     $request->validate([
    //         'nama'=> 'required',
    //         'username'=> 'required',
    //         'email'=> 'required',
    //         'password'=> 'required',
    //     ]);


    //     $data = new User();
    //     $data->nama = $request->nama;
    //     $data->username = $request->username;
    //     $data->email = $request->email.'@app.com';
    //     $data->password = bcrypt($request->password);

    //     $saved = $data->save();

    //     if (!$saved) {
    //         return new JsonResponse(['status'=>'failed', 'message'=>'Ada Kesalahan'], 500);
    //     }
    //     return new JsonResponse(['status'=>'success', 'message'=>'Data tersimpan'], 201);


    // }
