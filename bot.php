<?php

// Reply
$API_URL = 'https://api.line.me/v2/bot/message/message';


$ACCESS_TOKEN = 'ouhqskdRP/sUP8uwpjAadPDJz6rj1Y3IR0/ZznmHBgsPmYq6Q+hzdEJ4OXgyw/8NaLy6GLAZYYbLhF/7S6i8K07k3yxT0sWcMEa6ixgJ2c0XIOEKRfUEQAsHVi4PbQU4HEk9GOq/cmdR3iRkQE9e5gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'ba6e01c3eb0671a32e7d9fb3dbabd67d';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                
                $text = $event['message']['text'];
                if( $text == 'สวัสดี') {
                    $reply_message = 'สวัสดีนายท่าน ';
                } else{
                    $reply_message = 'สวัสดีนายท่าน '. $text;
                }
            } else { 
                $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
            }
        } else {
            $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
        }

        if( strlen($reply_message) > 0 )
        {
            //$reply_message = iconv("tis-620","utf-8",$reply_message);
            $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => $reply_message]]
            'messages'  =>  '{"type":"bubble","header":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"header"}]},"hero":{"type":"image","url":"https://www.linefriends.com/img/img_sec.jpg","size":"full","aspectRatio":"2:1"},"body":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"body"},{"type":"text","text":"body"}]},"footer":{"type":"box","layout":"vertical","contents":[{"type":"text","text":"footer"}]}}'
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_FLEX_URL, $POST_HEADER, $post_body);


            echo "Result: ".$send_result."\r\n";
        }
    }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>