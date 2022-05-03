<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChannelMember;
use Hash;
use Session;
use Auth;

class AccountController extends Controller
{
    
    // Home page
    public function home()
    {
        $user = Session::get('user');
        $user = User::whereId($user->id)->first();
        return view('index', ['user' => $user]);
    }


    // Login a User
    public function login(Request $req)
    {
        $req->validate([
            'tenant_id'=>'required|max:100',
            'password'=>'required|max:100'
        ]);

        $user = User::where('tenant_id', '=', $req->tenant_id)->first();

        if($user)
        {
            if(Hash::check($req->password, $user->password))
            {
                unset($user->password);
                $req->session()->put('user', $user);
                return redirect('/');
            }
        }   
      
        return back()->with('failed', 'Tenant Id or Password is Invalid');
    }


    // Register a new User
    public function register(Request $req)
    {
        $req->validate([
            'tenant_id'=>'required|max:4|min:4|unique:user',
            'email'=>'required|max:100|email',
            'password'=>'required|min:6|max:100|confirmed',
            'name'=>'required|max:100',
            'contact_no'=>'required|max:50'
        ]);

        $user = new User();
        $user->tenant_id = $req->tenant_id;
        $user->email = $req->email;
        $user->name = $req->name;
        $user->contact_no = $req->contact_no;
        $user->password = Hash::make($req->password);
        $res = $user->save();

        if($res)
        {
            $member = new ChannelMember();
            $member->channel_id = 1;
            $member->user_id = $user->id;
            $member->save();

            return redirect('login')->with('success', 'User has been registered successfully!');
        }
        
        return back()->with('failed', 'An error has occurred');
    }


    public function logout(Request $req)
    {
        $req->session()->forget('user');
        $req->session()->flush();
        return redirect('login');
    }
}
