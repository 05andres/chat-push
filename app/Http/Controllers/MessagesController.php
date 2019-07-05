<?php

namespace App\Http\Controllers;

use Bschmitt\Amqp\Amqp;
use Illuminate\Http\Request;
use Mookofe\Tail\Tail;

class MessagesController extends Controller
{
    public function queue(Request $request)

    {
        $mensaje=$request->get('msg');
        (new Tail)->add('queue-name', $mensaje);
    }

    public function cusumirMessage($queue='chat1')
    {
        $mensaje=[];
        $options = array(
            'message_limit' => 50,
            'empty_queue_timeout' => 1,
        );

        (new Tail)->listenWithOptions('queue-name', $options, function ($message) use ($mensaje) {

            array_push($mensaje,$message);
        });

        dd($mensaje);

    }
}
