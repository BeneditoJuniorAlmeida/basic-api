<?php


require("../_app/Config.inc.php");
/* ------------------Recuperando dados do ajax--------------- */
$selecao = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

/* ------------------ Verificando qual formulário foi enviado ------------------- */


switch ($selecao) {
    case 'addUsuario':
        array_pop($_POST);
        $t = new Usuario();
        $r = $t->create_new_account_of_user($_POST);
        if($t->getResult() == 0){
            echo TAG_SUCCESS;
        }else{
            echo TAG_ERROR;
        }
        break;
}
