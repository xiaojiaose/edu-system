<?php

namespace App\Events;

use App\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMsgBroadcastEvent implements ShouldBroadcast
{

    private $fromUser;
    private $channel;
    private $content;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(int $teacherId, int $studentId, string $content, User $from)
    {
        $this->channel = "room.{$studentId}.{$teacherId}";
        $this->content = $content;
        $this->fromUser = $from;
        logger("channel", [$this->channel]);
    }

    /**
     * 广播频道
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel($this->channel);
    }

    /**
     * 广播内容
     *
     * @return string
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->fromUser->id,
            'name' => $this->fromUser->name,
            'content' => $this->content,
            'time' => Carbon::now()->toDateTimeString(),
        ];
    }

    /**
     * 广播的事件名称.如果未定义则默认为事件名称即 App\Events\PublicBroadcastEvent
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'chat';
    }


    /**
     * 判定事件是否广播
     *
     * @return bool
     */
    public function broadcastWhen()
    {
        return true;
    }
}
