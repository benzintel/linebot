<?php

// example: https://github.com/onlinetuts/line-bot-api/blob/master/php/example/chapter-01.php

include ('line-bot.php');

$channelSecret = 'ba6e01c3eb0671a32e7d9fb3dbabd67d';
$access_token  = 'yZ9BNMGXsjRnV7rLCMXGBPkHczkLYQogduWkeD5oscd384zV057P5uPjgT4/EF6CaLy6GLAZYYbLhF/7S6i8K07k3yxT0sWcMEa6ixgJ2c2fxYyXxoCyer2KL1uGUWQCeqkNnJ1K3Ql9ntJZNr61NAdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) {
		
	$bot->replyMessageNew($bot->replyToken, json_encode($bot->message));

	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}

	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();

}