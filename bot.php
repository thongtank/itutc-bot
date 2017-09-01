<?php
$access_token = 'El29kUlVlDnk43OQWxmUu3pLbqEB6vx3PGS5qwloangM7/dW/Z5A0qZ9Eua++8ExUlQrz9iHWzFBIXmgqrRS16wlwDcOPWwx+IzfWasHux2sNlrBc048VTNTZAa6eLFKIg2dD3uSPKu9j6+C/XBbqwdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);
$fp = fopen('event.txt', 'w');
fwrite($fp, $content);
fclose($fp);

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
