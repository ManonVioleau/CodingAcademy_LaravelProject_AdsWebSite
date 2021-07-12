<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


use App\Models\User;


class SignupController extends Controller
{
    public function form()
    {
        return view('signinup.signup');
    }

    public function dataprocess(Request $request)
    {
        // auto data scan and validate 
        $request->validate([

            'login'                 => 'bail|required|unique:users', // ajouter bail pour message erreur de la 1ere erreur seulement   
            'email'                 => 'bail|required|unique:users',
            'phone_number'          => ['bail', 'required', 'string', 'regex:/(0|\\+33|0033)[1-9][0-9]{8}/'],
            'password'              => 'bail|required|confirmed|min:4',
            'password_confirmation' => 'bail|required',
            'nickname'              => 'bail|required',


        ]);




        $user = User::create([


            'login'         => request('login'),
            'password'      => bcrypt(request('password')),
            'email'         => request('email'),
            'phone_number'  => request('phone_number'),
            'nickname'      => request('nickname'),
            'role'          => 0

        ]);
        event(new Registered($user));

         return redirect("/signin")->withSuccess('Great! You have Successfully loggedup');

    }
}
