<?php
namespace App;

class Telegram
{
	private $api_url = '';
    private $chat_id = '';
    
	public function __construct($token, $chat_id)
	{
		$this->api_url = 'https://api.telegram.org/bot' . $token;
		$this->chat_id = $chat_id;
	}
    
	public function send($message)
	{
		$text = trim($message);
		if (strlen(trim($text)) > 0) {
			$send = $this->api_url . "/sendmessage?parse_mode=Markdown&chat_id=" . $this->chat_id . "&text=" . urlencode($text);
			file_get_contents($send);
			return true;
		}
		return false;
	}
}