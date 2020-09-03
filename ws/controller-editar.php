<?php


require("../_app/Config.inc.php");
/* ------------------Recuperando dados do ajax--------------- */
$selecao = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

/* ------------------ Verificando qual formulário foi enviado ------------------- */


switch ($selecao) {
    case 'editarUsuario':
       array_pop($_POST);
       var_dump($_POST);
        $t = new Usuario();
        $r = $t->update(Usuario::ENTIDADE, $_POST);
        var_dump($t->getResult());
        exit;
        if ($t->getResult() == 1) {
            echo TAG_SUCCESS;
        } else {
            echo TAG_ERROR;
        }
        break;
}
