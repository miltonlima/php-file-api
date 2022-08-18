<?php

// Busca dados da API com token em arquivo
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.useargo.com/argo/v2/expense/158a9c9c-b81b-ec11-a83d-000d3a0466ca/refunds',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'access_token: af4c78e2-c37c-4bc5-ac79-1bc87000a70a',
    'client_id: 229213e4-9d40-3fe8-8c35-b29d1d483f06',
    'Cookie: .ASPXANONYMOUS=rakq6Q6kyW6itu5B4SkndI0DoN1azZ_Ugu_7L_GM5ntuzLY1UKItV0EGHxNsTbhdT0AU2bNDKHj02qXRJqeK24ybIQs8geg581u4Rxdm_hpCzUv-c7bNDnYoTb3Kn6JqP1eaow2; ASP.NET_SessionId=z2fdiq4urbund2vs2rrohpst; TMS=Agencia=/promotional&Cliente=sescregional'
  ),
));

$response = curl_exec($curl);

$vjson = json_decode($response);

curl_close($curl);

if (empty($vjson)) {
  //echo "não foi";
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
    CURLOPT_POSTFIELDS => '{
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

  $vjson = json_decode($response);

  curl_close($curl);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.useargo.com/argo/v2/expense/158a9c9c-b81b-ec11-a83d-000d3a0466ca/refunds',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'access_token: ' . $vjson->access_token,
      'client_id: 229213e4-9d40-3fe8-8c35-b29d1d483f06',
      'Cookie: .ASPXANONYMOUS=rakq6Q6kyW6itu5B4SkndI0DoN1azZ_Ugu_7L_GM5ntuzLY1UKItV0EGHxNsTbhdT0AU2bNDKHj02qXRJqeK24ybIQs8geg581u4Rxdm_hpCzUv-c7bNDnYoTb3Kn6JqP1eaow2; ASP.NET_SessionId=z2fdiq4urbund2vs2rrohpst; TMS=Agencia=/promotional&Cliente=sescregional'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  echo $response;
} else {
  // echo 'foi';
  echo $response;
}
