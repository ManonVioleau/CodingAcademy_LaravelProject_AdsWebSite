<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminController extends Controller
{
    public function form() {

        $user = Auth::user();

        if ($user->role !== 1) {
            redirect()->route('home');
        }

        return view('admin.admin');
    }  
    
}
