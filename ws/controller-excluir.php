<?php


require("../_app/Config.inc.php");
/* ------------------Recuperando dados do ajax--------------- */
$selecao = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

/* ------------------ Verificando qual formulário foi enviado ------------------- */


switch ($selecao) {
    case 'excluirUsuario':

        $id = $_POST['usuario_id'];

        $t = new Usuario();
        $r = $t->delete(Usuario::ENTIDADE, $id);
        if ($t->getResult() == 1) {
            echo TAG_SUCCESS;
        } else {
            echo TAG_ERROR;
        }
        break;
}
