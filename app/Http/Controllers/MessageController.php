<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\PayUService\Exception;
use App\Models\Message;
use App\Models\Attachment;
use App\Models\User;
use App\Events\MessagePost;
use Session;


class MessageController extends Controller
{

    // Receive messages by Channel
    public function receive(Request $req)
    {
        $res = Message::join('user', 'message.user_id', '=', 'user.id')
            ->where('message.channel_id', $req->query('channel_id'))
            ->leftJoin('attachment', 'message.attachment_id', '=', 'attachment.id')
            ->get([
                'message.id', 
                'message.user_id', 
                'message.channel_id', 
                'message.attachment_id', 
                'message.message', 
                'message.created_dtm',
                'user.name', 
                'user.picture', 
                'attachment.file_name', 
                'attachment.mb_size'
            ]);

        if ($res)
        {
            return response()->json($res, 200);
        }

        return response()->json('Message not found', 404);
    }


    // Send plain message by channel
    public function send(Request $req)
    {
        $user = Session::get('user');
        $msg = new Message();
        $msg->channel_id = $req->query('channel_id');
        $msg->user_id = $user->id;
        $msg->message = $req->message;
        $msg->attachment_id = 0;
        $res = $msg->save();

        if($res)
        {
            $msg = Message::where('id', $msg->id)->first();
            broadcast(new MessagePost($msg, $user))->toOthers();
            return response()->json($msg, 200);
        }

        return response()->json("An error has occurred during saving", 400);
    }


    // Upload attachment as message
    public function upload(Request $req)
    {
        if($req->file()) 
        {
            $user = Session::get('user');
            $fileExt = $req->file->extension();
            $filePath = $req->file('file')
                            ->storeAs('uploads', substr(md5(uniqid(rand(), true)), 16) . "." . $fileExt, 'public');

            $att = new Attachment();
            $att->file_name = $req->file->getClientOriginalName();
            $att->file_path =  'app/public/' . $filePath;
            $att->mb_size =  $req->file->getSize();
            $upload = $att->save();

            if($upload)
            {
                $msg = new Message();
                $msg->channel_id = $req->query('channel_id');
                $msg->user_id = $user->id;
                $msg->attachment_id = $att->id;
                $msg->message = json_decode($req->document)->message ?? "";
                $res = $msg->save();
        
                if($res)
                {
                    $res_msg = Message::where('id', $msg->id)->first();
                    $res_att = Attachment::where('id', $att->id)->first();
                    broadcast(new MessagePost($res_msg, $user, $res_att))->toOthers();

                    return response()->json([
                        'id' => $res_msg->id,
                        'user_id'=> $res_msg->user_id,
                        'channel_id' => $res_msg->channel_id,
                        'attachment_id' => $msg->attachment_id,
                        'message' => $res_msg->message,   
                        'created_dtm'=> $res_msg->created_dtm,
                        'name' => $user->name,          
                        'picture' => $user->picture,  
                        'file_name' => $res_att->file_name,
                        'mb_size' => $res_att->mb_size
                    ], 200);
                }
            }
        }

        return response()->json("An error has occurred during upload", 400);
    }


    // Download file attachment
    public function download(Request $req)
    {
        $att = Attachment::where('id', $req->query('id'))->first();

        if($att)
        {
            $file_path = storage_path($att->file_path);
            return Response::download($file_path, $att->file_name);
        }
        
        return response()->json("Attachment not found.", 404);
    }
}
