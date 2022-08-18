<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.useargo.com/oauth/access-token/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "username": "adminapi",
    "password": "Api@2022",
    "reseller": "promotional",
    "corp": "sescregional",
    "grant_type": "password"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic MjI5MjEzZTQtOWQ0MC0zZmU4LThjMzUtYjI5ZDFkNDgzZjA2OmFmYzY1MWNiLTIxMGQtM2U2Mi05YTJjLTliMmI3ZjE1NGIzYw==',
    'Cookie: ASP.NET_SessionId=z2fdiq4urbund2vs2rrohpst; TMS=Agencia=/promotional&Cliente=sescregional'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
