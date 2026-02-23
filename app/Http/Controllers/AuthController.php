<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function index() {
        /**
         * ? function index akan menjalankan view 'login.blade.ph di dalam folder 'auth'
         * ? lalu mengirimkan data 'title'
         */

        return view('auth.login', [
            'title' => 'Login Sinvesta',
        ]);
    }
}
