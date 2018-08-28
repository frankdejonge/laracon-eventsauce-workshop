<?php

namespace App\EventSauce;

use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\MessageDispatcher;

class LaravelMessageDispatcher implements MessageDispatcher
{
    public function dispatch(Message ... $messages)
    {
        foreach ($messages as $message) {
            EventSauceJob::dispatch($message);
        }
    }
}