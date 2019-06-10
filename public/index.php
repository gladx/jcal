<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config.php";

use App\Jcal;
use App\Telegram;

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

$bot = new Telegram(BOT_TOKEN, $chat_id);

if($message == '/jcal_3') {
    $bot->send(Jcal::get3());
} else if($message == '/dev'){
    $bot->send(file_get_contents('readme.md'));
} else {
    $bot->send(Jcal::getDefault());
}