<?php
// pega dados do arquivo tarefas.txt e coloca na tela
if (file_exists("token.txt")) {
  $lista = file_get_contents("token.txt");
  $lista_array = explode("\n", $lista);
  foreach ($lista_array as $lista_item) {
    echo $lista_item . '<br/>';
  }
} else {
  $lista = null;
}
