<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = ''; 
$channelSecret = '';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        if ( $event['type'] == 'message' ) {
            if( $event['message']['type'] == 'text' ) {
                $reply_message = $event['message']['text'];
            } else { 
                $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
            }
        } else {
            $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
        }

        if( strlen($reply_message) > 0 )
        {
            $data = [
                'replyToken' => $reply_token,
                'messages' => [['type' => 'text', 'text' => $reply_message]]
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

            send_reply_message($API_URL, $POST_HEADER, $post_body);
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