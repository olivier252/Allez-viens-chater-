<?php

namespace Oliv\app;

class Message
{
    private $username;
    private $message;
    private $date ;

    const USERNAME_CHAR = 3;
    const MESSAGE_CHAR = 10;

    public function __construct($username, $message, ?\DateTime $date = null)
    {
        $this->username = $username;//vaut $_POST['username']
        $this->message = $message;//vaut $_POST['message']
        $this->date = $date ?: new \DateTime();//vaut null
    }

    public static function json_To_Object(string $json):Message
    {
        $data = json_decode($json, true);
        return new self($data['username'], $data['message'], new \DateTime("@". $data['date']));
    }

    public function isValid(): bool
    {
        return strlen($this->username) > self::USERNAME_CHAR &&
        strlen($this->message) > self::MESSAGE_CHAR;
    }

    public function getErrors(): array
    {
        $error = [];
        if(strlen($this->username) < self::USERNAME_CHAR) {
            $error['username'] = "votre pseudo doit comporter au moins 3 caractères";
        }
        if(strlen($this->message) < self::MESSAGE_CHAR){
            $error['message'] = "votre message doit comporter au moins 10 caractères";
        }
        return $error;
    }

    public function convertJSON():string
    {
        $array_encode = [
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ];

        return json_encode($array_encode);

    }

    public function toHTML():string
    {
        $username = htmlentities($this->username);
        $message = nl2br(htmlentities($this->message));
        $this->date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d-m-Y à H:i');

        return <<<HTML
        <p>
            <strong>$username</strong> : <em>$date</em><br>$message
        </p>
HTML;
    }
}