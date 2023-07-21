<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Jobs\RegisterEmailJobs;

class AuthController extends Controller
{
    // Register
    public function signUp(){
        return view('Auth.auth-signup');
    }

    public function register(Request $request){
        \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:filter|unique:App\Models\User',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => 'format :attribute salah',
            'unique' => ':attribute is ready'
        ])->validate();

        $FourDigitRandomNumber = mt_rand(1111,9999);
        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'verified' => $FourDigitRandomNumber,
            ]
        );

        dispatch(new RegisterEmailJobs($user,$FourDigitRandomNumber));    

        if($user){
            return redirect()->route('verify',['email' => $user->email])->with('message', 'Please check email to get verification');    
        }else{
            return redirect()->back()->with('errors', 'Failed');
        }
    }

    // verify akun
    public function verify($email){
        return view('Auth.auth-two-step', [
        'email' => $email
        ]);
    }

    public function verifyAction(Request $request){
        \Validator::make($request->all(), [
            'a1' => 'required',
            'a2' => 'required',
            'a3' => 'required',
            'a4' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ])->validate();

        $merge = $request->a1.$request->a2.$request->a3.$request->a4;

        $check = User::whereEmail($request->email)->first();

        if($check->verified == $merge){
            User::updateOrCreate(
                ['email' => $request->email],
                [
                    'email_verified_at' => now()
                ]
            );

             return redirect()->route('login')->with('message', 'Akun Anda Telah Aktif');
        }else{
             return redirect()->back()->withErrors(['Silahkan Cek Kembali Email']);
        }
    }

    // login
    public function login(){
        return view('Auth.auth-signin');
    }

    public function signin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $check = User::where('email',$request->email)->first();

        if(!$check){
            return redirect()->back()->with('danger','Email atau password salah');
        }

        if(@$check){
            if($check->email_verified_at ==  null){
                return redirect()->back()->withErrors(['Akun Anda Belun Aktif, Silahkan Cek Email ']);
            }else{
                $condition = Auth::attempt($request->only('email', 'password'), $request->has('remember'));    
            }
        }else{
            return redirect()->back()->withErrors(['Email atau password salah']);
        }


        if($condition){
            $user = Auth::user();
            return redirect(route('dashboard.home'));
        }else{
            return redirect()->back()->withErrors(['Email atau password salah']);
        }

    }

    // logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
