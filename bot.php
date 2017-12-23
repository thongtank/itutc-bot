<?php
/*
Array
(
[replyToken] => nHuyWiB7yP5Zw52FIkcQobQuGDXCTA
[type] => message
[timestamp] => 1462629479859
[source] => Array
(
[type] => user
[userId] => U206d25c2ea6bd87c17655609a1c37cb8
)
[message] => Array
(
[id] => 325708
[type] => text
[text] => Hello, world
)
)
 */
require_once __DIR__ . '/vendor/autoload.php';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('El29kUlVlDnk43OQWxmUu3pLbqEB6vx3PGS5qwloangM7/dW/Z5A0qZ9Eua++8ExUlQrz9iHWzFBIXmgqrRS16wlwDcOPWwx+IzfWasHux2sNlrBc048VTNTZAa6eLFKIg2dD3uSPKu9j6+C/XBbqwdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'eead3f759f457b2e8d3e711a074ef8d0']);

$content = file_get_contents('php://input');
// Decode json data into array
$events = json_decode($content, true);
// Get events index 0
$data = $events['events'][0];
$replyToken = $data['replyToken'];

// $replyMessage = 'ทุนเท่ากัน DD เท่ากัน 10%
// จาร A: สอนเทรดได้ order ละ 500 - 1000 จุด
// จาร A: ได้กำไรวันละ $10-$20
// ----------
// จาร B: สอนเทรดได้ order ละ 50-100 จุด
// จาร B: ได้กำไรวันละ $50 - $100
// เรียนกับใครดี ?';

// if ($data['message']['text'] == 'Hi') {
//     $replyMessage = 'ไฮ';
// } elseif ($data['message']['text'] == 'Yo') {
//     $replyMessage = "โย่";
// } else {
//     $replyMessage = "ควย";
// }

$topic = trim($data['message']['text']);
$query_string = 'tp=' . urlencode($topic);
// $replyMessage = $query_string;
$json = file_get_contents('http://139.99.5.183/~tonglineat/get_reply.php?' . $query_string);
$replyMessage = json_decode($json)
// $replyMessage = $replyMessage['reply_msg'];

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($replyMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
exit();

// แบบ No SDK
$access_token = 'El29kUlVlDnk43OQWxmUu3pLbqEB6vx3PGS5qwloangM7/dW/Z5A0qZ9Eua++8ExUlQrz9iHWzFBIXmgqrRS16wlwDcOPWwx+IzfWasHux2sNlrBc048VTNTZAa6eLFKIg2dD3uSPKu9j6+C/XBbqwdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['message']['text'];
            // Get replyToken
            $replyToken = $event['replyToken'];

            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $text,
            ];

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result . "\r\n";
        }
    }
}
echo "OK";
