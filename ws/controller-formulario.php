<?php


require("../_app/Config.inc.php");
/* ------------------Recuperando dados do ajax--------------- */
$selecao = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
/* ------------------ Verificando qual formulário foi enviado ------------------- */


switch ($selecao) {
    case 'addUsuario':
        echo 'AQUI ';
        break;
}
