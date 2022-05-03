<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\ChannelMember;
use Session;


class ChannelController extends Controller
{

    // Get channel list
    public function getList()
    {
        $user = Session::get('user');
        $res = Channel::join('channelmember', 'channelmember.channel_id', '=', 'channel.id')
            ->where('channelmember.user_id', '=', $user->id)
            ->where('channel.is_deleted', '=', 0)
            ->orderBy('id', 'ASC')
            ->get(['channel.id', 'channel.name', 'channel.description', 'channel.creator_id', 'channel.modified_dtm']);
 
        
        return $res;
    }
    
    // Create a new channel
    public function create(Request $req)
    {
        $user = Session::get('user');
        $channel = new Channel();
        $channel->name = $req->name;
        $channel->description = $req->description;
        $channel->creator_id = $user->id;
        $res = $channel->save();

        if($res)
        {
            $channel = Channel::whereId($channel->id)->first();
            $member = new ChannelMember();
            $member->channel_id = $channel->id;
            $member->user_id = $user->id;
            $member->save();
            return response()->json($channel, 200);
        }

        return response()->json("An error has occurred during saving", 500);
    }


    // Update existing Channel owned by user
    public function update(Request $req)
    {
        $user = Session::get('user');
        $res = Channel::whereId($req->id)
            ->where('id', '<>', 1)
            ->where('creator_id', '=', $user->id)
            ->update([
                'name' => $req->name,
                'description' => $req->description
            ]);

        if($res)
        {
            $channel = Channel::whereId($req->id)->first();
            return response()->json($channel, 200);
        }

        return response()->json("An error has occurred during update", 400);
    }


    // Delete existing Channel owned by User
    public function delete(Request $req)
    {
        $user = Session::get('user');
        $res = Channel::whereId($req->query('channel_id'))
            ->where('id', '<>', 1)
            ->where('creator_id', '=', $user->id)
            ->update(['is_deleted' => 1]);

        if($res)
        {
            $channel = Channel::whereId($req->query('channel_id'))->first();
            ChannelMember::where('channel_id', $req->id)->delete();
            return response()->json($channel, 200);
        }

        return response()->json("An error has occurred during deletion", 400);
    }
}
