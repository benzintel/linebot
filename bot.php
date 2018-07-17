<?php


$API_URL = 'https://api.line.me/v2/bot/message';
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
                'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);


            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

            $data = [
                'to' => $event['source']['userId'],
                'messages' => [
                    [
                        'type' => 'flex', 
                        'altText' => 'This is a Flex Message',
                        'contents'  =>  [
                            'type'  =>  'bubble',
                            'hero'  =>  [
                                'type'  =>  'image',
                                'url'   =>  'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_3_movie.png',
                                'size'  =>  'full',
                                'aspectRatio'   =>  '20:13',
                                'aspectMode'    =>  'cover',
                                'action'    =>  [
                                    'type'  =>  'uri',
                                    'uri'   =>  'https://bitkub.com'
                                ]
                            ],
                            'body'  =>  [
                                'type'  =>  'box',
                                'layout'    =>  'vertical',
                                'spacing'   =>  'md',
                                'contents'  =>  [
                                    [
                                        'type'      => 'box',
                                        'layout'    => 'vertical',
                                        'margin'    => 'lg',
                                        'spacing'   => 'sm',
                                        'contents'  => [
                                            [
                                                'type'      => 'text',
                                                'text'      => 'CLICK TO CHECK CURRENT PRICE',
                                                'weight'    => 'bold',
                                                'color'     => '#1DB446',
                                                'size'      => 'sm'
                                            ]
                                        ]
                                    ],
                                    [
                                        'type'  => 'separator',
                                        'margin'=> 'lg'
                                    ],
                                    [
                                        'type'      => 'box',
                                        'layout'    => 'vertical',
                                        'margin'    => 'lg',
                                        'spacing'   => 'sm',
                                        'contents'  =>  [
                                            'type'      => 'box',
                                            'layout'    => 'horizontal',
                                            'spacing'   => 'sm',
                                            'contents'  =>  [
                                                [
                                                    'type'      => 'box',
                                                    'layout'    => 'horizontal',
                                                    'spacing'   => 'sm',
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'BTC',
                                                            'displayText'   => 'Bitcoin',
                                                            'data'          => 'BTC'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'ETH',
                                                            'displayText'   => 'ETH',
                                                            'data'          => 'ETH'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'WAN',
                                                            'displayText'   => 'WAN',
                                                            'data'          => 'WAN'
                                                        ]
                                                    ]
                                                ],
                                                [
                                                    'type'      => 'box',
                                                    'layout'    => 'horizontal',
                                                    'spacing'   => 'sm',
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'ADA',
                                                            'displayText'   => 'ADA',
                                                            'data'          => 'ADA'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'OMG',
                                                            'displayText'   => 'OMG',
                                                            'data'          => 'OMG'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'XRP',
                                                            'displayText'   => 'XRP',
                                                            'data'          => 'XRP'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]

                                ]
                            ],
                            'footer'    =>  [
                                'type'      => 'box',
                                'layout'    => 'vertical',
                                'contents'  =>  [
                                    'type'  => 'button',
                                    'margin'=> 'sm',
                                    'action'=> [
                                        'type'  => 'uri',
                                        'label' => 'CHECK OUT BITKUB MARKET',
                                        'uri'   => 'https://www.bitkub.com/market'
                                    ],
                                    'style' => 'secondary'
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $post_body = json_encode($data);

            $send_result = send_reply_message($API_URL.'/push', $POST_HEADER, $post_body);


            echo "Result: ".$send_result."\r\n";
        }
    }
}


$data = [
                'to' => 'userId',
                'messages' => [
                    [
                        'type' => 'flex', 
                        'altText' => 'This is a Flex Message',
                        'contents'  =>  [
                            'type'  =>  'bubble',
                            'hero'  =>  [
                                'type'  =>  'image',
                                'url'   =>  'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_3_movie.png',
                                'size'  =>  'full',
                                'aspectRatio'   =>  '20:13',
                                'aspectMode'    =>  'cover',
                                'action'    =>  [
                                    'type'  =>  'uri',
                                    'uri'   =>  'https://bitkub.com'
                                ]
                            ],
                            'body'  =>  [
                                'type'  =>  'box',
                                'layout'    =>  'vertical',
                                'spacing'   =>  'md',
                                'contents'  =>  [
                                    [
                                        'type'      => 'box',
                                        'layout'    => 'vertical',
                                        'margin'    => 'lg',
                                        'spacing'   => 'sm',
                                        'contents'  => [
                                            [
                                                'type'      => 'text',
                                                'text'      => 'CLICK TO CHECK CURRENT PRICE',
                                                'weight'    => 'bold',
                                                'color'     => '#1DB446',
                                                'size'      => 'sm'
                                            ]
                                        ]
                                    ],
                                    [
                                        'type'  => 'separator',
                                        'margin'=> 'lg'
                                    ],
                                    [
                                        'type'      => 'box',
                                        'layout'    => 'vertical',
                                        'margin'    => 'lg',
                                        'spacing'   => 'sm',
                                        'contents'  =>  [
                                            'type'      => 'box',
                                            'layout'    => 'horizontal',
                                            'spacing'   => 'sm',
                                            'contents'  =>  [
                                                [
                                                    'type'      => 'box',
                                                    'layout'    => 'horizontal',
                                                    'spacing'   => 'sm',
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'BTC',
                                                            'displayText'   => 'Bitcoin',
                                                            'data'          => 'BTC'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'ETH',
                                                            'displayText'   => 'ETH',
                                                            'data'          => 'ETH'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'WAN',
                                                            'displayText'   => 'WAN',
                                                            'data'          => 'WAN'
                                                        ]
                                                    ]
                                                ],
                                                [
                                                    'type'      => 'box',
                                                    'layout'    => 'horizontal',
                                                    'spacing'   => 'sm',   
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'ADA',
                                                            'displayText'   => 'ADA',
                                                            'data'          => 'ADA'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'OMG',
                                                            'displayText'   => 'OMG',
                                                            'data'          => 'OMG'
                                                        ]
                                                    ],
                                                    [
                                                        'type'  => 'button',
                                                        'style' => 'primary',
                                                        'action'=> [
                                                            'type'          => 'postback',
                                                            'label'         => 'XRP',
                                                            'displayText'   => 'XRP',
                                                            'data'          => 'XRP'
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]

                                ]
                            ],
                            'footer'    =>  [
                                'type'      => 'box',
                                'layout'    => 'vertical',
                                'contents'  =>  [
                                    'type'  => 'button',
                                    'margin'=> 'sm',
                                    'action'=> [
                                        'type'  => 'uri',
                                        'label' => 'CHECK OUT BITKUB MARKET',
                                        'uri'   => 'https://www.bitkub.com/market'
                                    ],
                                    'style' => 'secondary'
                                ]
                            ]
                        ]
                    ]
                ]
            ];

echo json_encode($data);
// echo "OK";




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