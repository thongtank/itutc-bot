<?php
$access_token = 'El29kUlVlDnk43OQWxmUu3pLbqEB6vx3PGS5qwloangM7/dW/Z5A0qZ9Eua++8ExUlQrz9iHWzFBIXmgqrRS16wlwDcOPWwx+IzfWasHux2sNlrBc048VTNTZAa6eLFKIg2dD3uSPKu9j6+C/XBbqwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;