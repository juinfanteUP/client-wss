<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use Session;


class UserController extends Controller
{

    // Get current user's profile details
    public function getProfileDetails()
    {
        $user = Session::get('user');
        return $user;
    }


    // Get All Users
    public function getList()
    {
        $res = User::orderBy('name', 'ASC')
                    ->get(['id', 'tenant_id','name', 'email', 'picture', 'contact_no', 'modified_dtm']);
        return $res;  
    }
    

    // Update User Profile
    public function updateProfile(Request $req)
    {
        $user = Session::get('user');
        $res = User::whereId($user->id)->update([
            'email' => $req->email,
            'name' => $req->name,
            'contact_no' => $req->contact_no
        ]);

        if($res){
            $user = User::whereId($user->id)
                ->first(['id', 'tenant_id','name', 'email', 'picture', 'contact_no', 'modified_dtm']);

            return response()->json($user, 200);
        }

        return response()->json("An error has occurred during update", 400);
    }


    // Update User Password
    public function updatePassword(Request $req)
    {        
        $user = Session::get('user');
        $res = User::whereId($user->id)->update([
            'password' => Hash::make($req->password)
        ]);

        if($res)
        {
            return response()->json(null, 200);
        }

        // Return response
        return Response::json("An error has occurred during update", 400);
    }


    // Update Profile Picture
    public function updatePicture(Request $req)
    {
        $user = Session::get('user');

        if($req->file()) 
        {
            $fileExt = $req->file->extension();
            $imgPath = Storage::disk('profiles')->put('uploads', $req->file('file'));

            $res = User::whereId($user->id)->update([ 'picture' => $imgPath ]);

            if($res)
            {
                $user->picture = $imgPath;
                $req->session()->put('user', $user);
                session()->save();
                return response()->json($imgPath, 200);
            }
        }

        return response()->json("An error has occurred during profile update", 200);
    }
}
