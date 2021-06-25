<?php

namespace App\Events;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SendAdminNotificationUserRegisted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($email, $course, $optione = false)
    {
        $notify = new Notification();

        if (!$optione) { // notify have user registed account
            $content = "Email account $email has been successfully registered.";
            $notify->type = Config::get('variable.unread');
            $notify->content = $content;

        } else { // notify have user registed an acourse
            $content = "Email account $email just registered for the course is $course->name";
            $notify->type = Config::get('variable.unread');;
            $notify->content = $content;
        }

        $notify->save();
        $this->data = $notify;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['development'];
        // return new PrivateChannel('channel-name');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
