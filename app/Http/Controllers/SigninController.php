<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;



class SigninController extends Controller
{
    public function form()
    {
        return view('signinup.signin');
    }

    public function dataprocess(Request $request)
    {
        $request->validate([
            'login'     => 'required',
            'password'  => 'required',
        ]);

        $infos = $request->only('login', 'password');
        if (Auth::attempt($infos)) {
            $request->session()->regenerate();
            
            return redirect()->route('admin', ['infos' => $infos]);
                // ->withSuccess('Welcome '.$infos['login']);
        }

        return redirect("/signin")->withSuccess('Opps! You have entered invalid credentials');
    }

    public function valid()
    {
        if (Auth::check()) {
            return view('index');
        }

        return redirect("/signin")->withSuccess('Opps! You do not have access');
    }


    // public function catchuser()
    // {
    //     $email = request('email');

    //     $user = User::where('email', $email)->first();
    //     return view('.', [
    //         'user' => $user,
    //     ]);
    // }



    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return Redirect('/');
    }
}
