<?php
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('El29kUlVlDnk43OQWxmUu3pLbqEB6vx3PGS5qwloangM7/dW/Z5A0qZ9Eua++8ExUlQrz9iHWzFBIXmgqrRS16wlwDcOPWwx+IzfWasHux2sNlrBc048VTNTZAa6eLFKIg2dD3uSPKu9j6+C/XBbqwdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'eead3f759f457b2e8d3e711a074ef8d0']);

// $content = file_get_contents('php://input');

// // parse to JSON data
// $data = json_decode($content, true);

// $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
// $response = $bot->replyMessage($data['events']['replyToken'], $textMessageBuilder);

// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

// exit();

// // // รับค่าจาก request body content
// // $content = file_get_contents('php://input');

// // // parse to JSON data
// // $data = json_decode($content, true);

// // $file = fopen("event.txt","w");
// // fwrite($file, $data);
// // fclose($file);

// // exit();
