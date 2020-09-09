<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != Auth::user()->id) {
            return redirect('/bookings');
        }
        $user = Auth::user();

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user->id == $id) {

            return view('users.edit',['user' => $user]);
        }
        
        return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request -> input('name');
        $phone = $request -> input('phone');
        $email = $request -> input('email');
        $license = $request -> input('license');
        $credit = $request -> input('credit');
        $address = $request -> input('address');

        DB::table('users')->where('id', $id)->update(['name' => $name, 'phone' => $phone, 'email' => $email, 'license' => $license, 'credit' => $credit, 'address' => $address]);

        return redirect('/users/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != Auth::user()->id) {
            return redirect('/home');
        }
        
        DB::table('users')->where('id',$id)->delete();

        return redirect('/home');
    }
}
