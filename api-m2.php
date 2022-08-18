<?php

date_default_timezone_set('America/Sao_Paulo');

function tirarAcentos($string)
{
  return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
}

// Ler token de arquivo
// pega dados do arquivo tarefas.txt e coloca na tela
if (file_exists("token.txt")) {
  $lista = file_get_contents("token.txt");
  $lista_array = explode("\n", $lista);
  foreach ($lista_array as $lista_item) {
    //echo $lista_item . '<br/>';
  }
} else {
  $lista = null;
}

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
    'access_token: ' . $lista,
    'client_id: 229213e4-9d40-3fe8-8c35-b29d1d483f06',
    'Cookie: .ASPXANONYMOUS=rakq6Q6kyW6itu5B4SkndI0DoN1azZ_Ugu_7L_GM5ntuzLY1UKItV0EGHxNsTbhdT0AU2bNDKHj02qXRJqeK24ybIQs8geg581u4Rxdm_hpCzUv-c7bNDnYoTb3Kn6JqP1eaow2; ASP.NET_SessionId=z2fdiq4urbund2vs2rrohpst; TMS=Agencia=/promotional&Cliente=sescregional'
  ),
));

$response = curl_exec($curl);

$vjson = json_decode($response);

curl_close($curl);

// Verifica se trouxe dados da api, senão solicita novo token 
if (empty($vjson)) {
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
    "username": "tiger",
    "password": "Api@123",
    "reseller": "promotion",
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

  //Salvar token em arquivo
  //criamos o arquivo 
  $arquivo = fopen('token.txt', 'w');
  //verificamos se foi criado 
  if ($arquivo == false) die('Não foi possível criar o arquivo.');
  //escrevemos no arquivo 
  $texto = $vjson->access_token;
  fwrite($arquivo, $texto);
  //Fechamos o arquivo após escrever nele 
  fclose($arquivo);

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

  //echo '1: ' . tirarAcentos($response);
  $result = tirarAcentos($response);
} else {
  //echo '2: ' . tirarAcentos($response);
  $result = tirarAcentos($response);
}

echo "<br><br><br>" . $result . "<br><br><br>";

$jres = json_decode($response, true);

// print_r($jres);

// echo "<br><br><br>";

foreach ($jres as $key => $value) {
  # code...
  //echo $key->$value;
  //echo $key."<br>";
  foreach ($jres[$key] as $key1 => $value1) {
    # code...
    //echo $key->$value;
    echo $key1 . ': ';
    if ($value1) {
      echo $value1 . "<br>";
    } else {
      echo "<br>";
    }
  }
  echo " -- <br>";
}

//echo $key;

// Salvar dados da api em arquivo
//criamos o arquivo 
$arquivo = fopen('dados' . date('dmYhis') . '.json', 'w');
//verificamos se foi criado 
if ($arquivo == false) die('Não foi possível criar o arquivo.');
//escrevemos no arquivo 
$texto = $result;
fwrite($arquivo, $texto);
//Fechamos o arquivo após escrever nele 
fclose($arquivo);
