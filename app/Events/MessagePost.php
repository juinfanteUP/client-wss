<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Attachment;
use App\Models\Message;
use App\Models\User;


class MessagePost implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $msg;
    public $att;
    public $user;


    public function __construct(Message $msg, User $user, Attachment $att= null)
    {
        $this->msg = $msg;
        $this->user = $user;

        $this->att = new Attachment();
        $this->att->file_name = $att == null ? "" : $att->file_name;
        $this->att->mb_size = $att == null ? "" : $att->mb_size;
    }


    public function broadcastOn()
    {
        return new Channel('channel.' . $this->msg->channel_id);
    }


    public function broadcastWith()
    {
        return [
            'id' => $this->msg->id,
            'user_id'=> $this->user->id,
            'channel_id' => $this->msg->channel_id,
            'attachment_id' => $this->msg->attachment_id,
            'message' => $this->msg->message,   
            'created_dtm'=> $this->msg->created_dtm,
            'name' => $this->user->name,          
            'picture' => $this->user->picture,  
            'file_name' => $this->att->file_name,
            'mb_size' => $this->att->mb_size
        ];
    }
}

