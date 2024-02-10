<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class RegisterController extends Controller
// {
//     public function register()
//     {
//         return view('register');
//     }
    
//     public function actionregister(Request $request)
//     {
//         $user = User::create([
//             'email' => $request->email,
//             'username' => $request->username,
//             'password' => Hash::make($request->password),
//         ]);

//         Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
//         return redirect('register');
//     }
// }
{
    public function getreg()
    {
        return view('register');
    }
 
    public function newreg(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'username'=> 'required|min:4|max:255|unique:users',
            'password' => 'required',
        ]);
 
        $validatedData['password'] = Hash::make($validatedData['password']);
 
        User::create($validatedData);

        // $request->session()->flash('Success','Registration Succesfull! Please Login');

        return redirect('/login')->with('Success','Registration Succesfull! Please Login');
    }
}

    // public function getregister(){
    //     $data=User::get();
    //     return response()->json($data);
    // }
    
    // public function postuser(Request $request){
    //     $data=$request->validate([
    //         'name' => 'required|max:255',
    //         'email' => 'required|email:rfc,dns|unique:users,email',
    //         'username' => 'required|min:4|max:255|unique:users',
    //         'password' => 'required|min:6|max:255',
    //     ]);
    //     $data['password'] = Hash::make($data['password']);
    //     User::create($data);
    //     return response()->json('Registration Succesfull');
               
    // }
    
    // public function updateuser(Request $request){
    //     $data=User::find($request->id);
    //     if(!$data){
    //         return response()->json('NotValid',500);
    //     }
    //     $data->update([
    //         'name'=> $request->name,
    //         'email'=> $request->email,
    //         'password'=> $request->password, 
    //     ]);
    //     return response()->json('Success');
    // }
    
//     public function deleteuser(Request $request){
//         $data=User::find($request->id);

//         if(!$data){
//             return response()->json('NotValid',500);
//         }
//         $data->delete();
//         return response()->json('Success');
//     }
// }
