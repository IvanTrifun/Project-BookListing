<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function user($username){
        $user = User::where('name', $username)->firstOrFail();

        return View::make('view')->with('user', $user);
    }
}
