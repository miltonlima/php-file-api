<?php 
//criamos o arquivo 
$arquivo = fopen('token.txt','w'); 
//verificamos se foi criado 
if ($arquivo == false) die('Não foi possível criar o arquivo.'); 
//escrevemos no arquivo 
$texto = "Olá Mundo !!!"; 
fwrite($arquivo, $texto); 
//Fechamos o arquivo após escrever nele 
fclose($arquivo);
