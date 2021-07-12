<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        $users = User::all()->skip($offset)->take($limit);
        $count = User::all()->count();
        // dd($users);
        return view('admin.users.show', [
            'users' => $users,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createView()
    {
        return view('admin.users.create');
    }

    // public function create(Request $request)
    // {

    //     return view('admin.users.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $page = 1)
    {
        if ($request->input('login') != null && $request->input('password') != null && $request->input('email') != null && $request->input('phone_number') != null && $request->input('nickname') != null && $request->input('role') != null) {
            $login_exists = User::where('login', $request->input('login'))->first();
            $email_exists = User::where('email', $request->input('email'))->first();

            if (isset($login_exists)) {
                $message = 'The Login already exists';
                return view('admin.users.create', [
                    'message' => $message,
                ]);
            } elseif (isset($email_exists)) {
                $message = 'The Email already exists';
                return view('admin.users.create', [
                    'message' => $message,
                ]);
            } else {
                User::create([
                    'login' => $request->input('login'),
                    'password' => bcrypt($request->input('password')),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'nickname' => $request->input('nickname'),
                    'role' => $request->input('role'),
                ]);
                $message = 'The User has been succesfully added';
                $limit = 5;
                $offset = ($page * $limit) - $limit;
                $users = User::all()->skip($offset)->take($limit);
                $count = User::all()->count();

                return view('admin.users.show', [
                    'message' => $message,
                    'users' => $users,
                    'count' => $count,
                    'limit' => $limit,
                    'page' => $page,
                ]);
            }
        } else {
            $message = 'You have to fill all of the inputs';
            return view('admin.users.create', [
                'message' => $message,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.update', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit_one(Request $request) // appeler dans la route sans argument
    {
       /* $validatedData = $request->validate([
            'champ' => $valeur
    ]);

    User::whereId($id)->update($validatedData);

    return redirect('???')->with('success', 'Your data is updated.');
    */
        echo("Coucou");
        print_r($request);
        echo($request);
        var_dump($request);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $page = 1)
    {
        $login_exists = User::where('id', '!=', $id)->where('login', $request->input('login'))->first();
        $email_exists = User::where('id', '!=', $id)->where('email', $request->input('email'))->first();

        $user = User::find($id);

        if (isset($login_exists)) {
            $message = 'The Login already exists';

            return view('admin.users.update', [
                'message' => $message,
                'user' => $user,
            ]);
        } elseif (isset($email_exists)) {
            $message = 'The Email already exists';
            return view('admin.users.update', [
                'message' => $message,
                'user' => $user,
            ]);
        } else {
            $user->login = $request->input('login');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->nickname = $request->input('nickname');
            $user->role = $request->input('role');
            $result = $user->save();
            if ($result) {
                $message = 'The User has been succesfully updated';
            } else {
                $message = 'We have encounter an error in the updating of the User';
            }
            $limit = 5;
            $offset = ($page * $limit) - $limit;
            $users = User::all()->skip($offset)->take($limit);
            $count = User::all()->count();

            return view('admin.users.show', [
                'message' => $message,
                'users' => $users,
                'count' => $count,
                'limit' => $limit,
                'page' => $page,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $page = 1)
    {
        $id = $request->delete;
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            $message = 'The User has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the User';
        }
        // dd($user);
        $limit = 5;
        $offset = ($page * $limit) - $limit;
        $users = User::all()->skip($offset)->take($limit);
        $count = User::all()->count();

        return view('admin.users.show', [
            'message' => $message,
            'users' => $users,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ]);
    }
}