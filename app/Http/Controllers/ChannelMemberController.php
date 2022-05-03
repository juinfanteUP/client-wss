<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\ChannelMember;
use Session;


class ChannelMemberController extends Controller
{

    // Get members from a given channel
    public function getMembers(Request $req)
    {
        $res = ChannelMember::join('user', 'channelmember.user_id', '=', 'user.id')
            ->where('channel_id', $req->query('channel_id'))
            ->get(['user.id', 'user.tenant_id', 'user.name', 'user.email', 'user.contact_no', 'user.modified_dtm']);

        return $res;
    }

    
    // Add a member to a given channel
    public function updateMembers(Request $req)
    {   
        $user = Session::get('user');
        $res = ChannelMember::where('channel_id', $req->query('channel_id'))->delete();
        $channel_id = $req->query('channel_id');

        $data = array_map(function ($id) use ($channel_id){
            return ['channel_id' => $channel_id, 'user_id' => $id];
        }, $req->user_list);
        
        $res = DB::table('channelmember')->insert($data);

        if($res)
        {
            $members = ChannelMember::where('channel_id', $req->query('channel_id'))->get();
            return response()->json($members, 200);
        }

        return response()->json("An error has occurred during adding of member", 400);
    }
}
