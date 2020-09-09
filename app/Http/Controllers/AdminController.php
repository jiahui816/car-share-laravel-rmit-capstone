<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{

    public function allusers()
    {
        $users = DB::table('users')->where('role','1')->get();

        return view('admins.allusers',['users' => $users]);
    }


}
