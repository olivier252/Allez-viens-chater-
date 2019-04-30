<?php

namespace Oliv\app;
require_once('Message.php');
class GuestBook
{
    private $file;

    public function __construct($file)
    {

        $this->file = $file;
    }

    public function addMessage(Message $message):void
    {
        file_put_contents($this->file, $message->convertJSON() . PHP_EOL, FILE_APPEND);
    }

    public function getMessage():array
    {
        $messages= [];
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);

        foreach($lines as $json) {
            $messages[] = Message::json_To_Object($json);
        }
        return array_reverse($messages);
    }
}