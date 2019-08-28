<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Support\Facades\Log;
// use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Foundation\Events\Dispatchable;
// use Illuminate\Foundation\Bus\Dispatchable;


class MyEvent extends Event implements ShouldBroadcast
{
  use  SerializesModels;

  public $data;

  public function __construct($message)
  {
        $this->data =$message;
  }

  public function broadcastOn()
  {
      return ['my-channel'];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }
}