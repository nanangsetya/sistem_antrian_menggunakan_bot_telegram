<?php

namespace App\Traits;

use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

trait SendMsg
{
    function sendMessage($chat_id, $text, $reply_markup = null)
    {
        if ($reply_markup == null) {
            $reply_markup = Keyboard::remove(['selective' => false]);
        }
        return Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup
        ]);
    }
}
